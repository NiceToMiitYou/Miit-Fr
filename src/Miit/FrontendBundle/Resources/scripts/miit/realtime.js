(function(){
    function generateUrl(baseUrl, user, team, session) {
        var userId = 'userId=' + user.id;
        var teamId = 'teamId=' + team.id;
        var token  = 'token='  + session;

        return baseUrl + '?' + userId + '&' + teamId + '&' + token;
    }

    var MiitRealtime = injector.resolve(
        ['miit-storage', 'miit-user-store', 'miit-team-store', 'miit-session-store', 'miit-session-actions'],
        function(MiitStorage, MiitUserStore, MiitTeamStore, MiitSessionStore, MiitSessionActions) {
            
            // Get needed values
            var baseUrl = MiitStorage.shared.get('ws_url');
            var user    = MiitUserStore.getUser();
            var team    = MiitTeamStore.getTeam();
            var session = MiitSessionStore.getSessionId();

            // Generate the connexion URL
            var url = generateUrl(baseUrl, user, team, session);

            // Instanciate Primus
            var primus = Primus.connect(url, {
                manual: true
            });

            // Bind incoming data
            var onData = function(data) {
                console.log(data);

                if(primus.reserved(data.event)) return;

                primus.emit.call(primus, data.event, data);
            };

            // On session renewed
            var sessionRenewed = function() {
                
                // Open the connexion
                primus.open();

                // Bind incoming data
                primus.on('data', onData);
            };

            // Wait for session renewed
            MiitSessionStore.addSessionRenewedListener(sessionRenewed);

            return {
                send: function(eventName, data) {
                    if(!data) {
                        data = {};
                    }

                    data.event = eventName;

                    primus.write(data);
                },

                sendIn: function(roomName, eventName, data) {
                    if(!data) {
                        data = {};
                    }

                    data.event = eventName;

                    primus.in(roomName).write(data);
                },

                on: function(eventName, cb) {
                    primus.on(eventName, cb);
                }
            };
        }
    );

    injector.register('miit-realtime', MiitRealtime);
})();