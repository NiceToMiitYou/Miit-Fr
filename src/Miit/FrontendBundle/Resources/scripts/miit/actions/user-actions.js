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

            // Handle promote
            var onPromoted = function(id, roles, data) {
                var action = {
                    type: (data.done) ? ActionTypes.PROMOTE_USER_COMPLETED :
                                        ActionTypes.PROMOTE_USER_ERROR,
                    id: id,
                    roles: roles
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle demote
            var onDemoted = function(id, roles, data) {
                var action = {
                    type: (data.done) ? ActionTypes.DEMOTE_USER_COMPLETED :
                                        ActionTypes.DEMOTE_USER_ERROR,
                    id: id,
                    roles: roles
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle remove
            var onRemoved = function(id, data) {
                var action = {
                    type: (data.done) ? ActionTypes.REMOVE_USER_COMPLETED :
                                        ActionTypes.REMOVE_USER_ERROR,
                    id: id
                };

                MiitDispatcher.dispatch(action);
            };

            return {
                changePassword: function(password_old, password_new) {
                    // Request the server
                    MiitUserRequest.change_password(password_old, password_new, onPasswordChanged);
                },

                register: function(email, team) {
                    MiitUserRequest.registration(email, team, onRegistered.bind({}, email, team));
                },

                promote: function(id, roles) {
                    MiitUserRequest.promote(id, roles, onPromoted.bind({}, id, roles));
                },

                demote: function(id, roles) {
                    MiitUserRequest.demote(id, roles, onDemoted.bind({}, id, roles));
                },

                remove: function(id) {
                    MiitUserRequest.remove(id, onRemoved.bind({}, id));
                }
            };
        }
    );

    injector.register('miit-user-actions', UserActions);
})();