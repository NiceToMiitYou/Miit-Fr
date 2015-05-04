MiitComponents.UserProfile = React.createClass({
   getDefaultProps: function() {
        return {
            text: {
                logout:    'Déconnexion'
            }
        };
    },

    getInitialState: function () {
        return {
            open: false  
        };
    },

    onLeave: function() {
        this.setState({
            open: false
        });
    },

    onEnter: function() {

        this.setState({
            open: !this.state.open
        });
    },

    render: function() {
        var user = this.props.user;

        if(!this.props.user) {
            user = MiitApp.storage.shared.get('user');
        }

        return (
            <span className="miit-component user-profile">
                <div className="avatar">
                    <MiitComponents.UserAvatar user={user} />
                </div>
                <span onMouseLeave={this.onLeave} onClick={this.onEnter}>
                    { user.name }
                    <i className="fa fa-angle-up pull-right"></i>
                    <If test={this.state.open}>
                        <div className="dropdown-profile">
                            <Link href="/logout" external={true}>
                                {this.props.text.logout}
                            </Link>
                        </div>
                    </If>
                </span>
            </span>
        );
    }
});