window.MiitApp = (function() {
    var MiitApp = injector.resolve(
        ['miit-utils', 'miit-storage', 'miit-router', 'miit-request'],
        function(MiitUtils, MiitStorage, MiitRouter, MiitRequest) {
            var VERSION = '0.0.0';

            return {
                VERSION: VERSION,
                request: MiitRequest,
                router:  MiitRouter,
                storage: MiitStorage,
                utils:   MiitUtils
            };
        }
    );

    return MiitApp();
})();