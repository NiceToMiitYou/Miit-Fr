(function(){
    var UserStore;

    MiitComponents.MiitTeamSettings = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    informations: 'Informations'
                }  
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        render: function() {
            var user = UserStore.getUser();

            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{user.name}</h1>
                        
                        <div className="panel mt30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i>{this.props.text.informations}</h2>
                            <div className="panel-content">
                                <div className="row">
                                    <MiitComponents.UserChangePassword />
                                </div>
                            </div>
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