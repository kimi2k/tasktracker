;(function( $, window, document, App, undefined ) {

    var Module = {

        // Default variables.
        defaults : {
            e$addForm : null,
        },

        init : function() {
            var self = this;
            self.addForm = self.options.e$addForm;
            self.addFormBtn = self.addForm.find('button');
            self._bindEvents()._subscriptions();
            return self;
        },

        // basic events for actions
        _bindEvents : function() {
            var self = this;
            self.addFormBtn.on( 'click', function() {
                self.add();
            })

            return self;
        },

        // subscribe to events of application (need for blocking)
        _subscriptions : function() {
            var self = this;

            return self;
        },

        add : function() {
            var self = this;
            var title = self.addForm.find("input[name='title']");
            var description = self.addForm.find("input[name='description']");
            $.post("/ajax/categories", {action: 'add', title: title.val(), description: description.val()}, function(data) {
                   if (data) {
                       title.val("");
                       description.val("");
                       $(".reveal-modal-bg").trigger('click'); //close the form
                   }
            });
            return self;
        },

        printLilst : function() {
            var self = this;

            return self;
        }


    };

    App.moduleClass('categories', Module);
})( jQuery, window, document, App);