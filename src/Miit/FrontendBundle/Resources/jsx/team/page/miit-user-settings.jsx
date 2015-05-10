(function(){
    var UserStore;

    MiitComponents.MiitUserSettings = React.createClass({
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

        componentDidMount: function() {
            UserStore.addUserUpdatedListener(this._onChanged);
        },

        componentWillUnmount: function() {
            UserStore.removeUserUpdatedListener(this._onChanged);
        },

        _onChanged: function() {
            this.forceUpdate();
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
                                    <h3 className="mb20"><i className="fa fa-key pull-left"></i> Modifier vos informations</h3>
                                    <MiitComponents.UserUpdate />
                                    <h3 className="mb20 mt40"><i className="fa fa-key pull-left"></i> Changer de mot de passe</h3>
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
        .registerMainPage('me', (<MiitComponents.MiitUserSettings />));
})();