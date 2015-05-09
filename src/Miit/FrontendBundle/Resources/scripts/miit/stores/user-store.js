(function(){
    var Me;

    // Generate the validator for user's role
    var isUserGenerator = function(role) {
        return function(user) {
            var roles = (user || Me || {}).roles || [];

            return roles.indexOf(role) >= 0;
        };
    };

    // Check if this is the same user
    var isItMe = function(user) {
        var me  = (Me || {}).id || null;
        var you = (user || {}).id || null;

        return me === you;
    };

    var MiitUserStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-storage', 'miit-dispatcher', 'miit-user-constants'],
        function(ObjectAssign, KeyMirror, MiitStorage, MiitDispatcher, MiitUserConstants) {
            var ActionTypes = MiitUserConstants.ActionTypes;

            Me = MiitStorage.shared.get('user');

            var events = KeyMirror({
                // Event on password Change
                PASSWORD_CHANGED: null,
                PASSWORD_NOT_CHANGED: null
            });

            var UserStore = ObjectAssign({}, EventEmitter.prototype, {
                getUser: function() {
                    return Me;
                },

                isAdmin: isUserGenerator('ADMIN'),
                
                isUser:  isUserGenerator('USER'),
                
                isOwner: isUserGenerator('OWNER'),
                
                isItMe:  isItMe
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