(function(){
    var TeamStore;

    MiitComponents.MiitTeamSettings = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    informations: 'Informations'
                }  
            };
        },

        componentWillMount: function() {
            if(!TeamStore) {
                TeamStore = MiitApp.get('miit-team-store');
            }
        },

        render: function() {
            var team = TeamStore.getTeam();

            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{team.name}</h1>
                        
                        <div className="panel mt30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i>Title</h2>
                           
                        </div>
                    </div>
                </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('us', (<MiitComponents.MiitTeamSettings />));
})();