(function(){
    var MiitUserStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-dispatcher', 'miit-user-constants', 'miit-user-request'],
        function(ObjectAssign, KeyMirror, MiitDispatcher, MiitUserConstants, MiitUserRequest) {
            var ActionTypes = MiitUserConstants.ActionTypes;

            var events = KeyMirror({
                // Event on password Change
                PASSWORD_CHANGED: null,
                PASSWORD_NOT_CHANGED: null
            });


            var UserStore = ObjectAssign({}, EventEmitter.prototype, {

            });

            UserStore.generateNamedFunctions(events.PASSWORD_CHANGED);
            UserStore.generateNamedFunctions(events.PASSWORD_NOT_CHANGED);

            UserStore.dispatchToken = MiitDispatcher.register(function(action){

            });

            return UserStore;
        }
    );

    injector.register('miit-user-store', MiitUserStore);
})();