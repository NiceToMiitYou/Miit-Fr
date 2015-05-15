(function(){
    var MiitSession = injector.resolve(
        ['miit-utils'],
        function(MiitUtils) {
            return {
                renew: function(cb) {

                    // Renew the session
                    MiitUtils.ajax.send('/app/session/renew', cb);
                }
            };
        }
    );

    injector.register('miit-session-request', MiitSession);
})();