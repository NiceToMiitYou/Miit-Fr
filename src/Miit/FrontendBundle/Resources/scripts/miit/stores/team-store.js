(function(){
    var Users = [], RealtimeUsers = [], Team;

    function _update(name, publix) {
        Team.name   = name;
        Team.public = publix;
    }

    function _addUser(user) {
        if(!user) {
            return;
        }

        var index = Users.indexBy('id', user.id || '');
        
        if(index < 0) {
            Users.push(user);
        }
        // Synchronise
        _addRealtimeUser(user);
    }

    function _addRealtimeUser(user) {
        if(!user) {
            return;
        }

        var index = RealtimeUsers.indexBy('id', user.id || '');
        
        if(index < 0) {
            RealtimeUsers.push(user);
        } else {
            RealtimeUsers[index] = user;
        }
    }

    function _synchronizeUsers() {
        Users.forEach(function(user) {
            _addRealtimeUser(user);
        });
    }

    function _replaceUsers(users) {
        Users = users;
        _synchronizeUsers();
    }

    function _replaceRealtimeUsers(users) {
        RealtimeUsers = users;
        _synchronizeUsers();
    }

    function _filterbyRoleUser(role) {
        return Users.filter(function(user) {
            return user.roles.indexOf(role) >= 0;
        });
    }

    function _getUserById(id) {
        return Users.findBy('id', id);
    }

    function _removeUser(id) {
        var index = Users.indexBy('id', id);
        
        if(index >= 0) {
            delete Users[index];
        }
    }

    function _promoteUser(id, roles) {
        var index = Users.indexBy('id', id);

        if(Users[index] && Array.isArray(Users[index].roles)) {

            Users[index].roles.merge(roles);
        }
    }

    function _demoteUser(id, roles) {
        var index = Users.indexBy('id', id);

        if(Users[index] && Array.isArray(Users[index].roles)) {

            Users[index].roles.removeAll(roles);
        }
    }

    var MiitTeamStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-storage', 'miit-dispatcher', 'miit-user-store', 'miit-team-constants'],
        function(ObjectAssign, KeyMirror, MiitStorage, MiitDispatcher, MiitUserStore, MiitTeamConstants) {
            var ActionTypes = MiitTeamConstants.ActionTypes;

            var events = KeyMirror({
                // Tean updated
                TEAM_UPDATED: null,
                TEAM_NOT_UPDATED: null,
                // Users refreshed
                REFRESHED: null,
                NOT_REFRESHED: null,
                // User invited
                INVITED: null,
                NOT_INVITED: null,
                // User promote
                PROMOTED: null,
                NOT_PROMOTED: null,
                // User demote
                DEMOTED: null,
                NOT_DEMOTED: null,
                // User removed
                REMOVED: null,
                NOT_REMOVED: null
            });

            var TeamStore = ObjectAssign({}, EventEmitter.prototype, {
                getTeam: function() {
                    if(!Team) {
                        Team = MiitStorage.shared.get('team');
                    }
                    return Team;
                },

                getUser: function(id) {
                    return _getUserById(id);
                },

                getUsers: function(filtered) {
                    if(!filtered) {
                        return RealtimeUsers;
                    }

                    return Users;
                },

                getUsersByRole: function(role) {
                    return _filterbyRoleUser(role);
                }
            });

            TeamStore.generateNamedFunctions(events.REFRESHED);
            TeamStore.generateNamedFunctions(events.NOT_REFRESHED);

            TeamStore.generateNamedFunctions(events.TEAM_UPDATED);
            TeamStore.generateNamedFunctions(events.TEAM_NOT_UPDATED);

            TeamStore.generateNamedFunctions(events.INVITED);
            TeamStore.generateNamedFunctions(events.NOT_INVITED);

            TeamStore.generateNamedFunctions(events.PROMOTED);
            TeamStore.generateNamedFunctions(events.NOT_PROMOTED);
            
            TeamStore.generateNamedFunctions(events.DEMOTED);
            TeamStore.generateNamedFunctions(events.NOT_DEMOTED);
            
            TeamStore.generateNamedFunctions(events.REMOVED);
            TeamStore.generateNamedFunctions(events.NOT_REMOVED);

            TeamStore.dispatchToken = MiitDispatcher.register(function(action){

                switch(action.type) {
                    case ActionTypes.REFRESH_USERS_COMPLETED:
                        _replaceUsers(action.users);
                        TeamStore.emitRefreshed();
                        break;
                    case ActionTypes.REFRESH_USERS_ERROR:
                        TeamStore.emitNotRefreshed();
                        break;

                    case ActionTypes.REFRESH_REALTIME_USERS_COMPLETED:
                        _replaceRealtimeUsers(action.users);
                        TeamStore.emitRefreshed();
                        break;

                    case ActionTypes.UPDATE_TEAM_COMPLETED:
                        _update(action.name, action.public);
                        TeamStore.emitTeamUpdated();
                        break;
                    case ActionTypes.UPDATE_TEAM_ERROR:
                        TeamStore.emitTeamNotUpdated();
                        break;

                    case ActionTypes.INVITE_USER_COMPLETED:
                        _addUser(action.user);
                        TeamStore.emitInvited();
                        break;
                    case ActionTypes.INVITE_USER_ERROR:
                        TeamStore.emitNotInvited();
                        break;

                    case ActionTypes.PROMOTE_USER_COMPLETED:
                        _promoteUser(action.id, action.roles);
                        TeamStore.emitPromoted();
                        break;
                    case ActionTypes.PROMOTE_USER_ERROR:
                        TeamStore.emitNotPromoted();
                        break;

                    case ActionTypes.DEMOTE_USER_COMPLETED:
                        _demoteUser(action.id, action.roles);
                        TeamStore.emitDemoted();
                        break;
                    case ActionTypes.DEMOTE_USER_ERROR:
                        TeamStore.emitNotDemoted();
                        break;

                    case ActionTypes.REMOVE_USER_COMPLETED:
                        _removeUser(action.id);
                        TeamStore.emitRemoved();
                        break;
                    case ActionTypes.REMOVE_USER_ERROR:
                        TeamStore.emitNotRemoved();
                        break;
                }

            });

            return TeamStore;
        }
    );

    injector.register('miit-team-store', MiitTeamStore);
})();