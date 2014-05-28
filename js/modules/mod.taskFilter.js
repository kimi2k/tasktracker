;(function( $, window, document, App, undefined ) {

    var Module = {

        // Default variables.
        defaults : {
            e$container : null,
        },

        init : function() {
            var self = this;
            self.moreBtn = self.options.e$container.find("#more_categories");
            self.lessBtn = self.options.e$container.find("#hide_categories");
            self.filterBlock = self.options.e$container.find(".category_filter");
            self._bindEvents()._subscriptions();
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;

            self.moreBtn.on( 'click', function(){
                self.showCategories();
            });
            self.lessBtn.on('click', function() {
                self.hideCategories();
            });

            return self;
        },

        // subscribe to events of application (need for blocking)
        _subscriptions : function() {
            var self = this;

            return self;
        },

        showCategories : function() {
            var self = this;
            self.filterBlock.removeClass('small')
            self.moreBtn.hide();
            self.lessBtn.css('display','block');
            return self;
        },

        hideCategories : function() {
            var self = this;
            self.filterBlock.addClass('small')
            self.moreBtn.show();
            self.lessBtn.hide();
            return self;
        }
    };

    App.moduleClass('taskFilter', Module);
})( jQuery, window, document, App);