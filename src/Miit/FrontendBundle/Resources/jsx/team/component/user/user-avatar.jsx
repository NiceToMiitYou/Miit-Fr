(function(){
    var Storage;

    MiitComponents.UserAvatar = React.createClass({
        componentWillMount: function() {
            if(!Storage) {
                Storage = MiitApp.get('miit-storage');
            }
        },

        render: function() {
            var user = this.props.user;

            if(!user) {
                user = Storage.shared.get('user') || {
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
})();
