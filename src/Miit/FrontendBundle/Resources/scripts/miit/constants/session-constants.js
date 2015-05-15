(function(){
    var MiitSessionConstants = injector.resolve(
        ['key-mirror'],
        function(KeyMirror) {
            return {
                ActionTypes: KeyMirror({
                    // Session Actions
                    SESSION_RENEW:   null,
                    SESSION_EXPIRE:  null,
                    SESSION_DESTROY: null
                })
            };
        }
    );

    injector.register('miit-session-constants', MiitSessionConstants);
})();