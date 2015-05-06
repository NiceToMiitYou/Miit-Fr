(function(){
    var UserActions = injector.resolve(
        ['miit-dispatcher', 'miit-user-constants', 'miit-user-request'],
        function(MiitDispatcher, MiitUserConstants, MiitUserRequest) {
            var ActionTypes = MiitUserConstants.ActionTypes;

            // Handle password change
            var onPasswordChanged = function(data) {
                var action = {
                    type: ActionTypes.CHANGE_PASSWORD_USER_ERROR
                };

                if(data.done)
                {
                    action.type = ActionTypes.CHANGE_PASSWORD_USER_COMPLETED;
                }

                MiitDispatcher.dispatch(action);
            };

            return {
                changePassword: function(password_old, password_new) {
                    // Request the server
                    MiitUserRequest.change_password(password_new, password_old, onPasswordChanged);
                }
            };
        }
    );

    injector.register('miit-user-actions', UserActions);
})();