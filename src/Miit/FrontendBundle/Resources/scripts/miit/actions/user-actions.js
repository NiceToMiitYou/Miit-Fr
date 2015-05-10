(function(){
    var UserActions = injector.resolve(
        ['miit-dispatcher', 'miit-user-constants', 'miit-user-request'],
        function(MiitDispatcher, MiitUserConstants, MiitUserRequest) {
            var ActionTypes = MiitUserConstants.ActionTypes;

            // Handle password change
            var onPasswordChanged = function(data) {
                var action = {
                    type: (data.done) ? ActionTypes.CHANGE_PASSWORD_USER_COMPLETED :
                                        ActionTypes.CHANGE_PASSWORD_USER_ERROR
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle update
            var onUpdated = function(name, data) {
                var action = {
                    type: (data.done) ? ActionTypes.UPDATE_USER_COMPLETED :
                                        ActionTypes.UPDATE_USER_ERROR,
                    name: name
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle register
            var onRegistered = function(email, team, data) {
                var action = {
                    type: (data.done) ? ActionTypes.REGISTER_USER_COMPLETED :
                                        ActionTypes.REGISTER_USER_ERROR,
                    email: email,
                    team: team
                };

                MiitDispatcher.dispatch(action);
            };

            return {
                changePassword: function(password_old, password_new) {
                    // Request the server
                    MiitUserRequest.change_password(password_old, password_new, onPasswordChanged);
                },

                changePassword: function(name) {
                    // Request the server
                    MiitUserRequest.update(name, onUpdated.bind({}, name));
                },

                register: function(email, team) {
                    MiitUserRequest.registration(email, team, onRegistered.bind({}, email, team));
                },
            };
        }
    );

    injector.register('miit-user-actions', UserActions);
})();