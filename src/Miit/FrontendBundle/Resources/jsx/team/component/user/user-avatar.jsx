MiitComponents.UserAvatar = React.createClass({
    render: function() {
        var user = this.props.user;

        if(!this.props.user) {
            user = MiitApp.storage.shared.get('user') || {
                avatar: '/img/logo-miit-light.png'
            };
        }

        return (
            <span className="miit-component user-avatar">
                <img src={user.avatar} {...this.props} />
            </span>
        );
    }
});