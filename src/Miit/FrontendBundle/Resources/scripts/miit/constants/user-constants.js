(function(){
    var MiitUserConstants = injector.resolve(
        ['key-mirror'],
        function(KeyMirror) {
            return {
                ActionTypes: KeyMirror({
                    // Change Password Actions
                    CHANGE_PASSWORD_USER_COMPLETED: null,
                    CHANGE_PASSWORD_USER_ERROR: null,
                    // Register Actions
                    REGISTER_USER_COMPLETED: null,
                    REGISTER_USER_ERROR: null
                })
            };
        }
    );

    injector.register('miit-user-constants', MiitUserConstants);
})();