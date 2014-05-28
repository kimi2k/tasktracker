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
        },

        init : function() {
            var self = this;
            self.list = self.options.e$container;
            self.tpl = self.options.e$rowTpl;
            self.date = self.options.e$filterDate.val().split('.').join('-');;
            self._bindEvents()._subscriptions().printTasks();;
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;
            console.log(self.date);
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
            $.post("/ajax/tasks",{action:'getList',created:self.date}, function(date){
                var list = date;
                for (x in list) {
                    var context = {
                        id: list[x].id,
                        name: list[x].name,
                        caption: list[x].caption,
                        created: list[x].created,
                        timeLimit: list[x].timeLimit
                        };
                    var html   = template(context);
                    self.list.append(html);
                }
            });

            return self;
        }


    };

    App.moduleClass('tasklist', Module);
})( jQuery, window, document, App);