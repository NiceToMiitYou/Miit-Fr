(function(){
    var SessionActions = injector.resolve(
        ['miit-dispatcher', 'miit-session-constants', 'miit-session-request'],
        function(MiitDispatcher, MiitSessionConstants, MiitSessionRequest) {
            var ActionTypes = MiitSessionConstants.ActionTypes;

            return {
                expire: function(session) {
                    var action = {
                        type: ActionTypes.SESSION_EXPIRE,
                        session: session
                    };

                    MiitDispatcher.dispatch(action);
                },

                renew: function() {
                    MiitSessionRequest.renew(function(data) {
                        var action = {};
                        
                        switch(data.status) {
                            case 'SESSION_RENEW':
                                action.type    = ActionTypes.SESSION_RENEW;
                                action.session = data.session;
                                break;
                            default:
                                action.type = ActionTypes.SESSION_DESTROY;
                                break;
                        }


                        MiitDispatcher.dispatch(action);
                    });
                }
            };
        }
    );

    injector.register('miit-session-actions', SessionActions);
})();