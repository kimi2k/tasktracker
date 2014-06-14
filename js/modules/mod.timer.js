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
            other = input;
            input = input.totalTime;
            var self = this;
            var hoursString = '00';
            var minutesString = '00';
            var secondsString = '00';
            var hours = 0;
            var minutes = 0;
            var seconds = 0;

            hours = Math.floor(input / (60 * 60));
            input = input % (60 * 60);

            minutes = Math.floor(input / 60);
            input = input % 60;

            seconds = input;

            hoursString = (hours >= 10) ? hours.toString() : '0' + hours.toString();
            minutesString = (minutes >= 10) ? minutes.toString() : '0' + minutes.toString();
            secondsString = (seconds >= 10) ? seconds.toString() : '0' + seconds.toString();

            self.totalTimer.html(hoursString+':'+minutesString+':'+secondsString);
            return self;
        }

    };

    App.moduleClass('timer', Module);
})( jQuery, window, document, App);