MiitApp.storage = (function(){
    "use strict";

    function Database(name) {
        var timeoutId = {};
        var internal  = {};

        this.set = function(key, value, expire) {
            internal[key] = value;
            if(undefined !== expire && null !== expire) {
                this.expire(key, expire);
            }
            return this;
        };

        this.get = function(key) {
            return internal[key];
        };

        this.expire = function(key, delay) {
            clearTimeout(timeoutId[key]);

            if(undefined !== delay && null !== delay) {
                // Set the timeout
                timeoutId[key] = setTimeout(function() {
                    this.remove(key);
                }.bind(this), delay);
            } else {
                this.remove(key);
            }
        };

        this.remove = function(key) {
            delete internal[key];
            return this;
        };

        this.clear = function() {
            internal = {};
            return this;
        };

        this.getName = function() {
            return name;
        };

        this.getData = function() {
            return internal;
        };
    }

    var obj = {};

    obj['create'] = function(name) {
        return new Database(name);
    };

    obj['shared'] = new Database('shared');

    return obj;
})();