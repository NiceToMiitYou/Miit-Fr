window.MiitApp = (function() {
    var MiitApp = injector.resolve(
        ['miit-utils', 'miit-storage', 'miit-router', 'miit-applications', 'miit-requests'],
        function(MiitUtils, MiitStorage, MiitRouter, MiitApplications, MiitRequests) {
            var VERSION   = '0.0.0';
            var COPYRIGTH = 'All rigths reserved to ITEvents.'

            // Initiliaze all application
            MiitApplications.init();

            return {
                COPYRIGTH: COPYRIGTH,
                VERSION:   VERSION,
                requests:  MiitRequests,
                router:    MiitRouter,
                storage:   MiitStorage,
                utils:     MiitUtils
            };
        }
    );

    return MiitApp();
})();