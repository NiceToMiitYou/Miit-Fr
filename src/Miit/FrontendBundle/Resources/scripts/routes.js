(function(router){
    var routes = router.routes();

    routes.set('/test', function() {
        console.log('test');
    });

    routes.set('/test2/:slug', function(slug) {
        console.log('test2', slug);
    });

    router.init();
})(MiitApp.router);