(function(){
    var MiitRouter = injector.resolve(
        ['miit-storage'],
        function(MiitStorage) {
            var router, routes;
            
            return {
                init: function() {
                    router = Router(this.routes().getData());

                    router.configure({
                        html5history: true,
                        run_handler_in_init: true,
                        convert_hash_in_init: true
                    });

                    router.init();
                },

                routes: function() {
                    routes = routes || MiitStorage.create('routes');
                    return routes;
                },

                setRoute: function(path) {
                    if(router) {
                        router.setRoute(path);
                    }
                }
            };
        }
    );

    injector.register('miit-router', MiitRouter);
})();