MiitComponents.UserAvatar = React.createClass({
    render: function() {
        var user = this.props.user;

        if(!this.props.user) {
            user = MiitApp.storage.shared.get('user') || {
                avatar: '/img/logo-miit-light.png'
            };
        }

        return (
            <div className="miit-component user-avatar">
                <img src={user.avatar} />
            </div>
        );
    }
});