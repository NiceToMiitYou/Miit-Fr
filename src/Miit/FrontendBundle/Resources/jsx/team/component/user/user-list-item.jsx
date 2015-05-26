(function(){
    var UserStore, UserStatusStore;

    MiitComponents.UserListItem = React.createClass({
        getDefaultProps: function() {
            return {
                user: {
                    id:    '',
                    name:  'unknow',
                    roles: []
                },
                email: true,
                roles: true
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
            if(!UserStatusStore) {
                UserStatusStore = MiitApp.get('miit-user-status-store');
            }
        },

        componentDidMount: function() {
            UserStatusStore.addStatusChangedListener(this._onChanged);
        },

        componentWillUnmount: function() {
            UserStatusStore.removeStatusChangedListener(this._onChanged);
        },

        _onChanged: function() {
            this.forceUpdate();
        },

        render: function() {
            var status = UserStatusStore.getUserStatusByUserId(this.props.user.id).toLowerCase();
            var name   = UserStore.getName(this.props.user);

            return (
                <div className="miit-component user-list-item">
                    <MiitComponents.UserAvatar user={this.props.user} />
                    <span className="pl10">{name}</span>
                    <span className={"status pl10 " + status}><i className="icon-logo-miit"></i></span>
                    <If test={this.props.email && UserStore.isUser()}>
                        <span className="pl10">{this.props.user.email}</span>
                    </If>
                    <If test={this.props.roles && UserStore.isAdmin()}>
                        <MiitComponents.UserListItemRoles user={this.props.user}/>
                    </If>
                </div>
            );
        }
    });
})();