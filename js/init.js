
$(document).foundation();
var props = {};

window.globalTimer = {
    start : false,
    totalTime : 0
}


if (App.moduleClass('taskFilter'))

    App.module('taskFilter', 'taskFilter', {
        e$container: $("#taskFilter")
    });

if (App.moduleClass('timer'))

    App.module('timer', 'timer', {
        e$timerContainer: $("#filter_date"),
        e$totalTimer : $(".total_timer"),
    });

if (App.moduleClass('tasks'))

    App.module('tasks', 'tasks', {
        e$container: $("#tasklist"),
        e$rowTpl: $("#tasklist_tpl"),
        e$filterDate: $("#filter_date"),
        e$addTaskForm: $("#addTask"),
        e$timerContainer: window.globalTimer,
    });

if (App.moduleClass('categories'))

    App.module('categories', 'categories', {
        e$addForm: $("#addCategory"),
    });


// application init.
App.init(props);