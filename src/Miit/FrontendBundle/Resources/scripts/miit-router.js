MiitApp.router = (function(Router){
    "use strict";

    var router = Router();

    router.configure({
        on: function() {
            var route = window.location.hash.slice(1);

            console.log(route);
        }
    });

    router.init();
    
    return router;
})(Router);