MiitApp.request.user = (function(){
    "use strict";

    var obj = {};

    obj['change_password'] = function(password_old, password_new, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('change_password', function(token) {

            // Register the user
            MiitApp.utils.ajax.send('/app/user/change_password', {
                'password_old': password_old,
                'password_new': {
                    'first':    password_new,
                    'second':   password_new
                },
                '_token':       token
            }, cb);
        });
    };

    obj['promote'] = function(user_id, user_roles, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('promote_user', function(token) {

            // Promote the user
            MiitApp.utils.ajax.send('/app/user/promote', {
                'id':     user_id,
                'roles':  user_roles,
                '_token': token
            }, cb);
        });
    };

    obj['demote'] = function(user_id, user_roles, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('demote_user', function(token) {

            // Demote the user
            MiitApp.utils.ajax.send('/app/user/demote', {
                'id':     user_id,
                'roles':  user_roles,
                '_token': token
            }, cb);
        });
    };

    obj['remove'] = function(user_id, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('remove_user', function(token) {

            // Demote the user
            MiitApp.utils.ajax.send('/app/user/remove', {
                'id':  user_id,
                '_token': token
            }, cb);
        });
    };

    obj['registration'] = function(email, team, cb) {

        // Request for CRSF
        MiitApp.utils.ajax.crsf('registration', function(token) {

            // Register the user
            MiitApp.utils.ajax.send('/register', {
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
    };

    return obj;
})();