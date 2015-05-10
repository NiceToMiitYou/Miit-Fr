(function(){
    var MiitTeam = injector.resolve(
        ['miit-utils'],
        function(MiitUtils) {
            return {
                users: function(cb) {
                    // List all users
                    MiitUtils.ajax.send('/app/team/users', cb);
                },

                invite: function(email, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('registration', function(token) {

                        // Register the user
                        MiitUtils.ajax.send('/app/team/invite', {
                            'email':  email,
                            '_token': token
                        }, cb);
                    });
                },

                update: function(name, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('update', function(token) {

                        // Update the user
                        MiitUtils.ajax.send('/app/team/update', {
                            'name':   name,
                            '_token': token
                        }, cb);
                    });
                },

                promote: function(user_id, user_roles, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('promote_user', function(token) {

                        // Promote the user
                        MiitUtils.ajax.send('/app/team/promote', {
                            'id':     user_id,
                            'roles':  user_roles,
                            '_token': token
                        }, cb);
                    });
                },

                demote: function(user_id, user_roles, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('demote_user', function(token) {

                        // Demote the user
                        MiitUtils.ajax.send('/app/team/demote', {
                            'id':     user_id,
                            'roles':  user_roles,
                            '_token': token
                        }, cb);
                    });
                },

                remove: function(user_id, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('remove_user', function(token) {

                        // Demote the user
                        MiitUtils.ajax.send('/app/team/remove', {
                            'id':  user_id,
                            '_token': token
                        }, cb);
                    });
                }
            };
        }
    );

    injector.register('miit-team-request', MiitTeam);
})();