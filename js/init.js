$(document).foundation();
var props = {};

if( App.moduleClass( 'taskFilter' ) )

    App.module( 'taskFilter', 'taskFilter', {
        e$container : $("#taskFilter")
    });

if( App.moduleClass( 'tasks' ) )

    App.module( 'tasks', 'tasks', {
        e$container : $("#tasklist"),
        e$rowTpl : $("#tasklist_tpl"),
        e$filterDate : $("#filter_date"),
        e$addTaskForm : $("#addTask"),
    });

if( App.moduleClass( 'categories' ) )

    App.module( 'categories', 'categories', {
        e$addForm : $("#addCategory"),
    });

// application init.
App.init( props );