(function(){
    var UserStore, TeamStore;

    MiitComponents.MiitTeamSettings = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    applications:  'Applications',
                    informations: 'Informations'
                }  
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
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
            if(!UserStore.isAdmin()) {
                return null;
            }

            var team = TeamStore.getTeam();

            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{team.name}</h1>
                        
                        <div className="panel mb30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i> {this.props.text.applications}</h2>
                            <div className="panel-content">
                                <div className="row">
                                    <ul className="app-list">

                                        <li>
                                            <a>
                                                <i className="fa fa-weixin bg-blue"></i>
                                                <span>Chat</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a>
                                                <i className="fa fa-question bg-green"></i>
                                                <span>Quizz</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a className="add-app">
                                                <i className="fa fa-plus bg-blue-grey"></i>
                                                <span>Ajouter une App</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div className="panel mt30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i>Title</h2>
                            
                            <h3 className="mb20"><i className="fa fa-key pull-left"></i> Modifier les informations</h3>
                            <MiitComponents.TeamUpdate />

                            <h3 className="mt40 mb10"><i className="fa fa-users pull-left"></i> Liste des utilisateurs</h3>
                            <MiitComponents.UserList autoload={true} />
                        </div>
                    </div>
                </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('settings', (<MiitComponents.MiitTeamSettings />));
})();