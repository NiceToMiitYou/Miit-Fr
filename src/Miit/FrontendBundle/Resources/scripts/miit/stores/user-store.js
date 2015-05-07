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

                switch(action.type) {
                    case ActionTypes.CHANGE_PASSWORD_USER_COMPLETED:
                        UserStore.emitPasswordChanged();
                        break;
                    case ActionTypes.CHANGE_PASSWORD_USER_ERROR:
                        UserStore.emitPasswordNotChanged();
                        break;
                }

            });

            return UserStore;
        }
    );

    injector.register('miit-user-store', MiitUserStore);
})();