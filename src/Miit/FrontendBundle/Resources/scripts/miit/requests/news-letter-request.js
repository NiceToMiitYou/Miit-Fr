(function(){
    var MiitNewsLetterRequest = injector.resolve(
        ['miit-utils'],
        function(MiitUtils) {
            return {
                registration: function(email, cb) {

                    // Request for CRSF
                    MiitUtils.ajax.crsf('news_letter', function(token) {

                        // Register the user
                        MiitUtils.ajax.send('/newsletter', {
                            'email':  email,
                            '_token': token
                        }, cb);
                    });
                }
            };
        }
    );

    injector.register('miit-news-letter-request', MiitNewsLetterRequest);
})();