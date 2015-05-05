(function(){
    // Application Class
    function Application(options, onReady) {
        var initialized = false;

        this.configure = function() {
            if(!initialized) {
                if(typeof options.configure === 'function') {
                    options.configure.call(this);
                }
                onReady();
            }
        };
    }

    var MiitApplications = injector.resolve(
        ['miit-router'],
        function(MiitRouter) {
            // list of all apps
            var applications = [];

            // Global variables
            var created    = 0;
            var configured = 0;

            var onReady = function() {
                if(created > configured) {
                    configured++;
                }

                if(created === configured) {
                    // Initialize router
                    MiitRouter.init();
                }
            };

            return {
                createApplication: function(options) {
                    var app = new Application(options, onReady);

                    applications.push(app); created++;

                    return app;
                },

                init: function() {
                    if(applications.length === 0) {
                        onReady();
                    } else {
                        applications.forEach(function(app){
                            app.configure();
                        });
                    }
                }
            };
        }
    );

    injector.register('miit-applications', MiitApplications);
})();