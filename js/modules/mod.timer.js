;(function( $, window, document, App, undefined ) {

    var Module = {

        // Default variables.
        defaults : {
            e$container : null,
        },

        init : function() {
            var self = this;
            self._bindEvents()._subscriptions();
            self.startTimer();
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;

            return self;
        },

        // subscribe to events of application (need for blocking)
        _subscriptions : function() {
            var self = this;

            return self;
        },

        // Start the timer.
        startTimer : function() {
            var self = this;

            return self;
        },

    };

    App.moduleClass('timer', Module);
})( jQuery, window, document, App);