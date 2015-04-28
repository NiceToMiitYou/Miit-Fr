MiitApp.request.team = (function(){
    "use strict";

    var obj = {};

    obj['users'] = function(cb) {
        // List all users
        MiitApp.utils.ajax.send('/app/team/users', cb);
    };

    obj['invite'] = function(email, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('registration', function(token) {

            // Register the user
            MiitApp.utils.ajax.send('/app/team/invite', {
                'email':  email,
                '_token': token
            }, cb);
        });
    };

    return obj;
})();