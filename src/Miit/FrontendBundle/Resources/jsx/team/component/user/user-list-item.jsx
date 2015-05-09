(function(){
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

        render: function() {
            return (
                <div className="miit-component user-list-item">
                    <MiitComponents.UserAvatar user={this.props.user} />
                    <span className="pl10">{this.props.user.name}</span>
                    <span className="pl10">{this.props.user.email}</span>
                    <MiitComponents.UserListItemRoles user={this.props.user}/>
                </div>
            );
        }
    });
})();