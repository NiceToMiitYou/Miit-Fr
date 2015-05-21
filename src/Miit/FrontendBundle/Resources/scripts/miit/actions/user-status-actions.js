(function(){
    var UserStatusActions = injector.resolve(
        ['miit-dispatcher', 'miit-user-status-constants', 'miit-realtime'],
        function(MiitDispatcher, MiitUserStatusConstants, MiitRealtime) {
            var ActionTypes = MiitUserStatusConstants.ActionTypes;

            function onStatusUpdate(data) {
                var action = {
                    type:   ActionTypes.UPDATE_USER_STATUS,
                    status: data.status
                };

                MiitDispatcher.dispatch(action);
            }

            function onStatusRefresh(data) {
                var action = {
                    type:   ActionTypes.REFRESH_USER_STATUS,
                    status: data.status
                };

                MiitDispatcher.dispatch(action);
            }

            MiitRealtime.on('user:status', onStatusUpdate);

            MiitRealtime.on('users:status', onStatusRefresh);

            // Refresh the whole list
            MiitRealtime.send('users:status');

            return {
                refresh: function() {
                    MiitRealtime.send('users:status');
                }
            };
        }
    );

    injector.register('miit-user-status-actions', UserStatusActions);
})();
