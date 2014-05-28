var props = {};

// init slider module at main page
if( App.moduleClass( 'taskFilter' ) )

    App.module( 'taskFilter', 'taskFilter', {
        e$container : $("#taskFilter"),
    });


// application init.
App.init( props );