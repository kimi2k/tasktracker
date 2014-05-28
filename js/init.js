$(document).foundation();
var props = {};
// init slider module at main page
if( App.moduleClass( 'taskFilter' ) )

    App.module( 'taskFilter', 'taskFilter', {
        e$container : $("#taskFilter")
    });

if( App.moduleClass( 'tasklist' ) )

    App.module( 'tasklist', 'tasklist', {
        e$container : $("#tasklist"),
        e$rowTpl : $("#tasklist_tpl"),
        e$filterDate : $("#filter_date"),
    });


// application init.
App.init( props );