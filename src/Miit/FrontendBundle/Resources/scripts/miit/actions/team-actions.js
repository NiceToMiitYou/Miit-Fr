(function(){
    var TeamActions = injector.resolve(
        ['miit-dispatcher', 'miit-team-constants', 'miit-team-request'],
        function(MiitDispatcher, MiitTeamConstants, MiitTeamRequest) {
            var ActionTypes = MiitTeamConstants.ActionTypes;

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

            // Handle invite
            var onInvited = function(data) {
                var action = {
                    type: (data.done) ? ActionTypes.INVITE_USER_COMPLETED :
                                        ActionTypes.INVITE_USER_ERROR,
                    user: data.user
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle update
            var onUpdated = function(name, data) {
                var action = {
                    type: (data.done) ? ActionTypes.UPDATE_TEAM_COMPLETED :
                                        ActionTypes.UPDATE_TEAM_ERROR,
                    name: name
                };

                MiitDispatcher.dispatch(action);
            };

            // Handle refresh
            var onRefresh = function(data) {
                var action = {
                    type: (data.done) ? ActionTypes.REFRESH_USERS_COMPLETED :
                                        ActionTypes.REFRESH_USERS_ERROR,
                    users: data.users
                };

                MiitDispatcher.dispatch(action);
            };

            return {
                refresh: function() {
                    MiitTeamRequest.users(onRefresh);
                },

                update: function(name) {
                    MiitTeamRequest.update(name, onUpdated.bind({}, name));
                },

                invite: function(email) {
                    MiitTeamRequest.invite(email, onInvited);
                },

                promote: function(id, roles) {
                    MiitTeamRequest.promote(id, roles, onPromoted.bind({}, id, roles));
                },

                demote: function(id, roles) {
                    MiitTeamRequest.demote(id, roles, onDemoted.bind({}, id, roles));
                },

                remove: function(id) {
                    MiitTeamRequest.remove(id, onRemoved.bind({}, id));
                }
            };
        }
    );

    injector.register('miit-team-actions', TeamActions);
})();