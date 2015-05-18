(function(){
    MiitComponents.MiitHome = React.createClass({
        getDefaultProps: function () {
            return {
                title: 'Welcome'
            };
        },
        
        // [TO REMOVE] Exemple de notifications 
        componentWillMount: function() {
            setTimeout(function(){
                MiitApp.get('miit-notifications-actions').new('valid', 'Bienvenue sur la page d\'accueil!');
            }, 250);
            setTimeout(function(){
                MiitApp.get('miit-notifications-actions').new('info', 'Bienvenue sur la page d\'accueil!');
            }, 1250);
            setTimeout(function(){
                MiitApp.get('miit-notifications-actions').new('danger', 'Bienvenue sur la page d\'accueil!');
            }, 4250);
        },

        render: function() {
            return (
                <div className="container-fluid">
                    <div className="page-header">
                        <a href="#" className="minimize-menu">
                            <i className="fa fa-bars"></i>
                        </a>
                        <h1>{this.props.title}</h1>
                        <MiitComponents.Clock />
                    </div>

                    <div className="sidr-right">
                        <span className="sr-label">Utilisateurs</span>
                        <MiitComponents.UserList headers={false} invite={false} roles={false} emails={false}/>
                    </div>
                </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('home', (<MiitComponents.MiitHome />));
})();