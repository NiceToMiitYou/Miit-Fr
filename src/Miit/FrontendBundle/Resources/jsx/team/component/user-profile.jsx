MiitComponents.UserProfile = React.createClass({
    render: function() {
        var user = this.props.user;

        if(!this.props.user) {
            user = MiitApp.storage.shared.get('user');
        }

        return (
            <span className="miit-component user-profile">
                <div className="avatar border-circle">
                    <MiitComponents.UserAvatar user={user} />
                </div>
                <span>{ user.name }
                    <i className="fa fa-angle-up pull-right"></i>
                </span>
            </span>
        );
    }
});