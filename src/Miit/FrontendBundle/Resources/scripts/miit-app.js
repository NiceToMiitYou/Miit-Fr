window.MiitApp = (function() {
    var MiitApp = injector.resolve(
        ['miit-applications'],
        function(MiitApplications) {
            var VERSION   = '0.0.0';
            var COPYRIGTH = 'All rigths reserved to ITEvents.';

            // Initiliaze all application
            MiitApplications.init();

            // Getter of services
            var getService = function(serviceName) {

                var proxyService = injector.resolve(serviceName, function(service) {
                    return service;
                });

                return proxyService();
            };

            return {
                COPYRIGTH: COPYRIGTH,
                VERSION:   VERSION,
                get:       getService
            };
        }
    );

    return MiitApp();
})();