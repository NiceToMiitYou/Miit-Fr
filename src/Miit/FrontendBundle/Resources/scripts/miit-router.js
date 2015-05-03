MiitApp.router = (function(Router){
    "use strict";
    
    var router, routes;
    
    return {
        init: function() {

            router = Router(routes.getData());

            router.configure({
                html5history: true,
                run_handler_in_init: true,
                convert_hash_in_init: true
            });

            router.init();
        },

        routes: function() {
            routes = routes || MiitApp.storage.create('routes');
            return routes;
        },

        setRoute: function(path) {
            if(router) {
                router.setRoute(path);
            }
        }
    };
})(Router);