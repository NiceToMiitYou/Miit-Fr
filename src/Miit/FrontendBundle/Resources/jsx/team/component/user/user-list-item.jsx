(function(){
    var UserStore;

    MiitComponents.UserListItem = React.createClass({
        getDefaultProps: function() {
            return {
                user: {
                    id:    '',
                    name:  'unknow',
                    roles: []
                }
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        render: function() {
            return (
                <div className="miit-component user-list-item">
                    <MiitComponents.UserAvatar user={this.props.user} />
                    <span className="pl10">{this.props.user.name}</span>
                    <If test={UserStore.isUser()}>
                        <span className="pl10">{this.props.user.email}</span>
                    </If>
                    <If test={UserStore.isAdmin()}>
                        <MiitComponents.UserListItemRoles user={this.props.user}/>
                    </If>
                </div>
            );
        }
    });
})();