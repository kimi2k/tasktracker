;(function( $, window, document, App, undefined ) {

    var Module = {

        // Default variables.
        defaults : {
            e$timerContainer : null,
            e$totalTimer : null
        },

        init : function() {
            var self = this;
            self.totalTimer = self.options.e$totalTimer;
//            window.globalTimer = self.options.e$timerContainer;

            $.post("/ajax/tasks?action=getworktime",{date: date('Y-m-d')},function(date){
                window.globalTimer.totalTime = date.seconds;
            });

            self._bindEvents()._subscriptions();
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;
            setInterval(function(){
                self.printTimer(window.globalTimer);
            },1000);
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

        printTimer : function(input) {
            var self = this;
            self.totalTimer.html(generateTimer(input.totalTime));
            return self;
        }

    };

    App.moduleClass('timer', Module);
})( jQuery, window, document, App);