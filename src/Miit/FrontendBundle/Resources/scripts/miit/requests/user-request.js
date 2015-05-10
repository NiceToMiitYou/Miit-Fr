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

                update: function(name, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('update', function(token) {

                        // Update the user
                        MiitUtils.ajax.send('/app/user/update', {
                            'name':   name,
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

    injector.register('miit-user-request', MiitUser);
})();