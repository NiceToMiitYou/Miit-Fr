(function(){
    var MiitPageStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-dispatcher', 'miit-storage', 'miit-router', 'miit-page-constants'],
        function(ObjectAssign, KeyMirror, MiitDispatcher, MiitStorage, MiitRouter, MiitPageConstants) {
            // All action types
            var ActionTypes = MiitPageConstants.ActionTypes;

            // All needed pages variables
            var CurrentMainPage, CurrentApplicationPage;

            // A storage for all pages
            var PageStorage = MiitStorage.create('pages');

            var events = KeyMirror({
                // Events on page Change
                MAIN_PAGE_CHANGED: null,
                APPLICATION_PAGE_CHANGED: null,
            });

            // The PageStore Object
            var PageStore = ObjectAssign({}, EventEmitter.prototype, {
                getCurrentMainPage: function() {
                    return PageStorage.get('main-' + CurrentMainPage);
                },

                getCurrentApplicationPage: function() {
                    return PageStorage.get('application-' + CurrentApplicationPage);
                },

                registerMainPage: function(name, component) {
                    PageStorage.set('main-' + name, component);
                },

                registerApplicationPage: function(name, component) {
                    PageStorage.set('application-' + name, component);
                }
            });

            // Register Functions based on event
            PageStore.generateNamedFunctions(events.MAIN_PAGE_CHANGED);
            PageStore.generateNamedFunctions(events.APPLICATION_PAGE_CHANGED);

            var handleChangeMainPage = function(action) {
                // On page changed
                if(action.mainPage &&
                   action.mainPage !== CurrentMainPage)
                {
                    // Set the current main page
                    CurrentMainPage = action.mainPage;
                    // Emit the change
                    PageStore.emitMainPageChanged();
                }
            };

            var handleChangeApplicationPage = function(action) {
                // On page changed
                if(action.applicationPage && 
                   action.applicationPage !== CurrentApplicationPage)
                {
                    // Set the current application page
                    CurrentApplicationPage = action.applicationPage;
                    // Emit the change
                    PageStore.emitApplicationPageChanged();
                }
                handleChangeMainPage(action);
            };

            // Handle actions
            PageStore.dispatchToken = MiitDispatcher.register(function(action){
                switch(action.type) {
                    case ActionTypes.CHANGE_APPLICATION_PAGE_COMPLETED:
                        handleChangeApplicationPage(action);
                        break;

                    case ActionTypes.CHANGE_MAIN_PAGE_COMPLETED:
                        handleChangeMainPage(action);
                        break;
                }
            });

            return PageStore;
        }
    );

    injector.register('miit-page-store', MiitPageStore);
})();