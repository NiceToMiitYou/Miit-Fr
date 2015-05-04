window.MiitApp = (function() {
    var MiitApp = injector.resolve(
        ['miit-utils', 'miit-storage', 'miit-router', 'miit-request'],
        function(MiitUtils, MiitStorage, MiitRouter, MiitRequest) {
            var VERSION   = '0.0.0';
            var COPYRIGTH = 'All rigths reserved to ITEvents.'

            // Initiliaze the router
            MiitRouter.init();

            return {
                COPYRIGTH: COPYRIGTH,
                VERSION:   VERSION,
                request:   MiitRequest,
                router:    MiitRouter,
                storage:   MiitStorage,
                utils:     MiitUtils
            };
        }
    );

    return MiitApp();
})();