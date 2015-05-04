(function(){
    var MiitUser = injector.resolve(
        ['miit-utils'],
        function(MiitUtils) {
            return {
                change_password: function(password_old, password_new, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('change_password', function(token) {

                        // Register the user
                        MiitUtils.ajax.send('/app/user/change_password', {
                            'password_old': password_old,
                            'password_new': {
                                'first':    password_new,
                                'second':   password_new
                            },
                            '_token':       token
                        }, cb);
                    });
                },

                promote: function(user_id, user_roles, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('promote_user', function(token) {

                        // Promote the user
                        MiitUtils.ajax.send('/app/user/promote', {
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
                        MiitUtils.ajax.send('/app/user/demote', {
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
                        MiitUtils.ajax.send('/app/user/remove', {
                            'id':  user_id,
                            '_token': token
                        }, cb);
                    });
                },

                registration: function(email, team, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('registration', function(token) {

                        // Register the user
                        MiitUtils.ajax.send('/register', {
                            'user': {
                                'email': email
                            },
                            'team': {
                                'name':  team
                            },
                            'terms':       true,
                            '_token':      token
                        }, cb);
                    });
                }
            };
        }
    );

    injector.register('miit-user', MiitUser);
})();