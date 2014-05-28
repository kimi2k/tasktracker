if ( typeof Object.create !== 'function' ) {
    Object.create = function( obj ) {
        function F(){};
        F.prototype = obj;
        return new F();
    }
}

// application object
var App = {};

;(function( $, window, document, App, undefined ) {

    $.extend( App, {

        _properties : {},
        _moduleClasses : {},
        _modules : {},
        _busy : {},

        // Application init
        init : function( properties ){
            var module;
            this._properties = properties;
            for( var i in this._modules ) {
                module = this._modules[i];
                module.options = $.extend( {}, module.defaults, module.options );
                module.init();
            }

            $.publish('App.init');
        },

        // add module of class with [name].
        // return the object of application
        moduleClass : function( name, obj ) {
            if( !this._moduleClasses[name] )
                this._moduleClasses[name] = obj;
            return this._moduleClasses[name];
        },

        module : function( id, type, options ) {
            if( !this._modules[id] )
                if( type ) {
                    this._modules[id] = Object.create( this.moduleClass(type) );
                    this._modules[id].id = id;
                    this._modules[id].options = options;
                }
            return this._modules[id];
        },

        property : function( name, value ) {
            if( !value )
                return ( this._properties[name] ) ? this._properties[name] : false;
            else
                return this._properties[name] = value;
        },

        busy : function( types, value ) {
            var 	types_array = types != undefined ? types.split( ',' ) : undefined;

            if( value != undefined ) {
                for( var i = 0, l = types_array.length; i < l; i++ ) {
                    this._busy[types_array[i]] = value;
                    $.publish( 'App.busy', [types_array[i], value] );
                }
                return this;
            }
            else {
                if( types_array != undefined ) {
                    for( var i = 0, l = types_array.length; i < l; i++ )
                        if( this._busy[types_array[i]] == 1 )
                            return true;
                }
                else
                    for( var i in this._busy )
                        if( this._busy[i] == 1 )
                            return true;
            }
            return false;
        },

    });

})( jQuery, window, document, App);