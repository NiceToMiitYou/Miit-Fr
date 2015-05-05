(function(){
    var MiitRequests = injector.resolve(
        ['miit-user-request', 'miit-team-request'],
        function(MiitUser, MiitTeam) {
            return {
                user: MiitUser,
                team: MiitTeam
            };
        }
    );

    injector.register('miit-requests', MiitRequests);
})();