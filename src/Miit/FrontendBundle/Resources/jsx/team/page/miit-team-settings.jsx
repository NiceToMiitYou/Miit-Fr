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

        componentDidMount: function() {
            TeamStore.addTeamUpdatedListener(this._onChanged);
        },

        componentWillUnmount: function() {
            TeamStore.removeTeamUpdatedListener(this._onChanged);
        },

        _onChanged: function() {
            this.forceUpdate();
        },

        render: function() {
            var team = TeamStore.getTeam();

            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{team.name}</h1>
                        
                        <div className="panel mt30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i>Title</h2>
                            <h3 className="mb20"><i className="fa fa-key pull-left"></i> Modifier les informations</h3>
                            <MiitComponents.TeamUpdate />
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