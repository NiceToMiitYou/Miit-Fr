(function(){
    var MiitRequest = injector.resolve(
        ['miit-user', 'miit-team'],
        function(MiitUser, MiitTeam) {
            return {
                user: MiitUser,
                team: MiitTeam
            };
        }
    );

    injector.register('miit-request', MiitRequest);
})();