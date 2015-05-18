(function(){
    MiitComponents.MiitHome = React.createClass({
        getDefaultProps: function () {
            return {
                title: 'Welcome'
            };
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