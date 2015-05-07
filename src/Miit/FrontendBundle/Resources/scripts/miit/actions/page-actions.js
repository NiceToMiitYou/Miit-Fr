(function(){
    var PageActions = injector.resolve(
        ['miit-dispatcher', 'miit-page-constants'],
        function(MiitDispatcher, MiitPageConstants) {
            var ActionTypes = MiitPageConstants.ActionTypes;

            return {
                changeMainPage: function(main) {
                    var action = {
                        type: ActionTypes.CHANGE_MAIN_PAGE_COMPLETED,
                        mainPage: main
                    };

                    MiitDispatcher.dispatch(action);
                },

                changeMiitPage: function(main, miit) {
                    var action = {
                        type: ActionTypes.CHANGE_MIIT_PAGE_COMPLETED,
                        mainPage: main,
                        miitPage: miit
                    };

                    MiitDispatcher.dispatch(action);
                },

                changeApplicationPage: function(main, miit, application) {
                    var action = {
                        type: ActionTypes.CHANGE_APPLICATION_PAGE_COMPLETED,
                        mainPage: main,
                        miitPage: miit,
                        applicationPage: application
                    };

                    MiitDispatcher.dispatch(action);
                }
            };
        }
    );

    injector.register('miit-page-actions', PageActions);
})();