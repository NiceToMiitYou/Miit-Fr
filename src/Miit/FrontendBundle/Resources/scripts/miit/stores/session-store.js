(function(){
    var SessionId;

    var MiitSessionStore = injector.resolve(
        ['object-assign', 'key-mirror', 'miit-dispatcher', 'miit-session-constants'],
        function(ObjectAssign, KeyMirror, MiitDispatcher, MiitSessionConstants) {
            // All action types
            var ActionTypes = MiitSessionConstants.ActionTypes;

            var events = KeyMirror({
                SESSION_RENEWED: null,
                SESSION_EXPIRED: null
            });

            // The PageStore Object
            var SessionStore = ObjectAssign({}, EventEmitter.prototype, {
                getSessionId: function() {
                    return SessionId;
                }
            });

            // Register Functions based on event
            SessionStore.generateNamedFunctions(events.SESSION_RENEWED);
            SessionStore.generateNamedFunctions(events.SESSION_EXPIRED);

            // Handle actions
            SessionStore.dispatchToken = MiitDispatcher.register(function(action){
                switch(action.type) {
                    case ActionTypes.SESSION_DESTROY:
                        window.reload(true);
                        break;

                    case ActionTypes.SESSION_EXPIRE:
                        if(action.session === SessionId) {
                            SessionId = 'EXPIRED';
                            SessionStore.emitSessionExpired();
                        }
                        break;

                    case ActionTypes.SESSION_RENEW:
                        if(action.session !== SessionId) {
                            SessionId = action.session;
                            SessionStore.emitSessionRenewed();
                        }
                        break;
                }
            });

            return SessionStore;
        }
    );

    injector.register('miit-session-store', MiitSessionStore);
})();