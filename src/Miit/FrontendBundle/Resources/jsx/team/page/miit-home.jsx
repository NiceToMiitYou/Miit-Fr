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

                            <div className="dialog-container hide">
                                <div className="notification-dialog nd-info">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing.</span>
                                </div>
                                <div className="notification-dialog">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing.</span>
                                </div>
                                <div className="notification-dialog nd-valid">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing.</span>
                                </div>
                                <div className="notification-dialog nd-warning">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing.</span>
                                </div>
                                <div className="notification-dialog nd-danger">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing.</span>
                                </div>
                            </div>
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