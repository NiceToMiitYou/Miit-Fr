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
                }
            };
        }
    );

    injector.register('miit-team-request', MiitTeam);
})();