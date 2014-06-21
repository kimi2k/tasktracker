/**
 * Created by kimi2k on 29.05.14.
 */
;(function( $, window, document, App, undefined ) {

    var Module = {

        // Default variables.
        defaults : {
            e$container : null,
            e$rowTpl : null,
            e$filterDate : null,
            e$addTaskForm : null,
            e$row : null,
            e$timerContainer : null
        },

        init : function() {
            var self = this;
            self.list = self.options.e$container;
            self.tpl = self.options.e$rowTpl;
            self.date = self.options.e$filterDate.val().split('.').join('-');;
            self.addTaskForm = self.options.e$addTaskForm;
            self.addTaskFormBtn = self.addTaskForm.find("button");
            self.row = self.options.e$row;
            self._bindEvents()._subscriptions().printTasks();
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;
            if (self.addTaskFormBtn && self.addTaskForm) {
                self.addTaskFormBtn.on( 'click', function() {
                    self.addTask();
                });
            }
            return self;
        },

        // subscribe to events of application (need for blocking)
        _subscriptions : function() {
            var self = this;
            return self;
        },

        printTasks : function() {
            var self = this;
            var source = self.tpl.html();
            var template = Handlebars.compile(source);
            cat_id = [];
            self.options.e$filterDate.parent().find('input[checked="checked"]').each(function(){
                cat_id.push($(this).val());
            })
            cat_id = cat_id.join(",");
            self.list.html("");
            p = {action:'getList',created:self.date};
            if (cat_id != '') {
                p.categories = cat_id;
            }

            $.post("/ajax/tasks",p, function(date){
                console.log(date);

                var list = date;
                for (x in list) {
                    var classes = '';
                    if (list[x].finished == 1) {
                        classes += ' finish'
                    }
                    if (list[x].finished != 1 && list[x].is_paused != 1 && list[x].start != null) {
                           classes += ' active';
                    }
                    var context = {
                        id: list[x].id,
                        name: list[x].name,
                        caption: list[x].caption,
                        created: list[x].created,
                        limit: list[x].time_limit,
                        timeLimit: generateTimer(list[x].time_limit),
                        taskTime : list[x].taskTime,
                        timer : generateTimer(list[x].taskTime),
                        classes : classes
                        };
                    var html   = template(context);
                    self.list.append(html);
                }
                self.list.find("img.delete").on( 'click', function(){
                    self.removeTask($(this));
                });
                self.list.find("img.start").on( 'click', function(){
                    self.startTask($(this).parent().parent().attr('task'));
                });
                self.list.find("img.pause").on( 'click', function(){
                   self.pauseTask($(this).parent().parent().attr('task'));
                });
                self.list.find("img.finish").on('click', function(){
                    self.finishTask($(this).parent().parent().attr('task'));
                });
                self.list.find("img.revert").on('click', function(){
                    self.revertTask($(this).parent().parent().attr('task'));
                });

                //checking active task
                if (self.list.find(".active").length >0) {
                    self.startTimer(self.list.find(".active").attr("task"));
                    self.list.find(".active img.pause").show();
                    self.list.find(".active img.start").hide();
                }
            });

            return self;
        },

        addTask : function() {
            var self = this;
            var timeLimit = self.addTaskForm.find('input[name="time_limit"]').val().split(':');
            if (timeLimit.length == 3) {
                timeLimit = parseInt(timeLimit[0])*3600 + parseInt(timeLimit[1])*60 + parseInt(timeLimit[2])
            } else {
                timeLimit = 0;
            }
            p = {},
            p.name = self.addTaskForm.find('input[name="title"]').val();
            p.caption = self.addTaskForm.find('textarea[name="description"]').val();
            p.time_limit = timeLimit;
            p.cat_id = self.addTaskForm.find('select[name="category"]').val();
            p.created = self.date+date(' H:i:s');
            error = false;
            if (p.title == '') {
                error = true;
                self.addTaskForm.find('input[name="title"]').addClass('error');
            } else {
                self.addTaskForm.find('input[name="title"]').removeClass('error');
            }
            p.action = 'add';
            $.post("/ajax/tasks", p, function(data) {
                if (data.error  == false) {
                    $(".reveal-modal-bg").trigger('click');
                    self.printTasks(); //reload task list
                    self.addTaskForm.find('input[name="title"]').val('');
                    self.addTaskForm.find('textarea[name="description"]').val('');
                    self.addTaskForm.find('input[name="time_limit"]').val('');
                    self.addTaskForm.find('select[name="category"]').val(0);
                } else {
                    alert(data.errorDescription);
                }
            })


            return self;
        },

        removeTask : function($this) {
            name = $this.parent().parent().find("td").eq(1).html();
            if (!confirm("Are you whant remove task '"+name+"'?")) {
                return false;
            }
            p = {
                action: 'delete',
                id : $this.attr("id")
            }
            $.post("/ajax/tasks", p, function(data){
                console.log(data);
                if (data.error == false) {
                    $this.parent().parent().remove();
                }
            })

        },

        startTimer : function(id) {
            var self = this;
            self.task = setInterval(function(){
                window.globalTimer.totalTime += 1;
                var $task = self.list.find('.task[task='+id+']');
                var time = parseInt($task.attr('time'))+1;
                $task.attr('time',time);
                $task.find('.timer').html(generateTimer(time));
                var limit = parseInt($task.attr('limit'))-1;
                $task.attr('limit',limit);
                if (limit >= 0) {
                    $task.find('.limit').html(generateTimer(limit));
                    $.post("/ajax/tasks?action=update", {id:id, time_limit: limit}, function(data) {
                        console.log(data);
                    });
                } else {
                    $task.find('.limit').html('expired');
                    $task.addClass('expired');
                }
            },1000);
            return self;
        },
        startTask : function(id) {
            var self = this;
            if (window.globalTimer.start == true && window.globalTimer.id != '') {
               self.pauseTask(window.globalTimer.id);
            }

            window.globalTimer.start = true;
            window.globalTimer.id = id;

            var $task = self.list.find('.task[task='+id+']');
            $task.addClass('active');


            $.post('/ajax/tasks?action=start',{id:id},function(data){
            })
            self.startTimer(id);
            $task.find('.pause').show();
            $task.find('.start').hide();

            return self;

        },

        pauseTask : function(id) {
            var self = this;
            window.globalTimer.start = false;
            window.globalTimer.id = true;
            clearInterval(self.task);

            $.post('/ajax/tasks?action=pause',{id:id},function(data){
                console.log(data);
            })
            var $task = self.list.find('.task[task='+id+']');
            $task.removeClass('active');
            $task.find('.pause').hide();
            $task.find('.start').show();
            return self;
        },

        finishTask : function(id) {
            var self = this;

            if (confirm("Are you really want finish task №"+id)) {
                $.post('/ajax/tasks?action=finish',{id:id},function(data){
                    self.printTasks();
                })
                var $task = self.list.find('.task[task='+id+']');
                $task.removeClass('active');
                $task.find('.pause').hide();
                $task.find('.start').hide();

            }
            return self;
        },

        revertTask : function(id) {
            var self = this;
            $.post('/ajax/tasks?action=revert',{id:id},function(data){
                self.printTasks();
            })
            return self;
        }


    };

    App.moduleClass('tasks', Module);
})( jQuery, window, document, App);