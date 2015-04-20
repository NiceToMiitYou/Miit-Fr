var MiitUser = (function(){
    "use strict";

    var obj = {};

    obj['change_password'] = function(password_old, password_new, cb) {

        // Request for CRSF
        MiitUtils.ajax.crsf('change_password', function(token) {

            // Register the user
            MiitUtils.ajax.send('/app/user/change_password', {
                'user_change_password_type[password_old]':         password_old,
                'user_change_password_type[password_new][first]':  password_new,
                'user_change_password_type[password_new][second]': password_new,
                'user_change_password_type[_token]':               token
            }, cb);
        });
    };

    obj['registration'] = function(email, team, cb) {

        // Request for CRSF
        MiitUtils.ajax.crsf('registration', function(token) {

            // Register the user
            MiitUtils.ajax.send('/register', {
                'registration_type[user][email]': email,
                'registration_type[team][name]':  team,
                'registration_type[terms]':       true,
                'registration_type[_token]':      token
            }, cb);
        });
    };

    return obj;
})();