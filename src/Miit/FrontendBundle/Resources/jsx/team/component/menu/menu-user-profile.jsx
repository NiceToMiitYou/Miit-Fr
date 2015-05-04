MiitComponents.MenuUserProfile = React.createClass({
   getDefaultProps: function() {
        return {
            text: {
                logout:    'Déconnexion'
            }
        };
    },

    render: function() {
        var user = MiitApp.storage.shared.get('user');

        return (
            <a className="sl-footer miit-component user-profile">
                <div className="avatar">
                    <MiitComponents.UserAvatar user={user} />
                </div>
                <Dropdown label={ user.name } angle="up">
                    <Link href="/logout" external={true}>
                        {this.props.text.logout}
                    </Link> 
                </Dropdown>
            </a>
        );
    }
});