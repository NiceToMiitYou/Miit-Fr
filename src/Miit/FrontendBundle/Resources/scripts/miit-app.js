window.MiitApp = (function() {
    var MiitApp = injector.resolve(
        ['miit-router'],
        function(MiitRouter) {
            var VERSION   = '0.0.0';
            var COPYRIGTH = 'All rigths reserved to ITEvents.';

            return {
                COPYRIGTH: COPYRIGTH,
                VERSION:   VERSION,
                get: function(serviceName) {
                    return injector.get(serviceName);
                },
                init: function() {
                    MiitRouter.init();
                }
            };
        }
    );

    return MiitApp();
})();