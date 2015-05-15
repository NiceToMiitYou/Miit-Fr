(function(){
    var Me, Utils;

    // Generate the validator for user's role
    function _isUserGenerator(role) {
        return function(user) {
            var roles = (user || Me || {}).roles || [];

            return roles.indexOf(role) >= 0;
        };
    }

    function _isAnonymous(userTmp) {
        var user  = (user || Me || { id: '' });

        return '4' === user.id.charAt(14);
    }

    // Check if this is the same user
    function _isItMe(user) {
        var me  = (Me || {}).id || null;
        var you = (user || {}).id || null;

        return me === you;
    }

    function _getName(user) {
        if(_isAnonymous(user)) {
            return MiitTranslator.get('user.anonymous',  'common');
        }
        return user.name;
    }

    function _update(name) {
        Me.name = name;
    }

    var MiitUserStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-storage', 'miit-dispatcher', 'miit-user-constants'],
        function(ObjectAssign, KeyMirror, MiitStorage, MiitDispatcher, MiitUserConstants) {
            var ActionTypes = MiitUserConstants.ActionTypes;

            Me    = MiitStorage.shared.get('user');

            var events = KeyMirror({
                // Event on password change
                PASSWORD_CHANGED: null,
                PASSWORD_NOT_CHANGED: null,
                // Event on update
                USER_UPDATED: null,
                USER_NOT_UPDATED: null,
            });

            var UserStore = ObjectAssign({}, EventEmitter.prototype, {
                getUser: function() {
                    return Me;
                },
                
                isOwner:  _isUserGenerator('OWNER'),

                isAdmin:  _isUserGenerator('ADMIN'),

                isUser:   _isUserGenerator('USER'),
                
                isAnonym: _isAnonymous,
                
                isItMe:   _isItMe,

                getName:  _getName
            });

            UserStore.generateNamedFunctions(events.PASSWORD_CHANGED);
            UserStore.generateNamedFunctions(events.PASSWORD_NOT_CHANGED);

            UserStore.generateNamedFunctions(events.USER_UPDATED);
            UserStore.generateNamedFunctions(events.USER_NOT_UPDATED);

            UserStore.dispatchToken = MiitDispatcher.register(function(action){

                switch(action.type) {
                    case ActionTypes.CHANGE_PASSWORD_USER_COMPLETED:
                        UserStore.emitPasswordChanged();
                        break;
                    case ActionTypes.CHANGE_PASSWORD_USER_ERROR:
                        UserStore.emitPasswordNotChanged();
                        break;

                    case ActionTypes.UPDATE_USER_COMPLETED:
                        _update(action.name);
                        UserStore.emitUserUpdated();
                        break;
                    case ActionTypes.UPDATE_USER_ERROR:
                        UserStore.emitUserNotUpdated();
                        break;
                }
            });

            return UserStore;
        }
    );

    injector.register('miit-user-store', MiitUserStore);
})();