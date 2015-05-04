MiitApp.applications = (function(){

    var noop         = function(){};
    var created      = 0;
    var configured   = 0;
    var applications = [];

    var onReady = function() {
        if(created === configured) {
            // Initialize router
            MiitApp.router.init();
        }
    };

    function Application(options) {

        this.configure = function() {
            if(typeof options.configure === 'function') {
                options.configure.call(this);
            }
            configured++;
            onReady();
        }
    }



    return {
        createApplication: function(options) {
            var app = new Application(options);

            applications.push(app);
            created++;

            return app;
        },
        
        init: function() {
            applications.forEach(function(app){
                app.configure();
            });
        }
    };
})();