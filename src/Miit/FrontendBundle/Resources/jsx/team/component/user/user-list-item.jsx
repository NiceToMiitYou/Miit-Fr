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
                <MiitComponents.UserAvatar user={this.props.user} height="32px" />
                <span>{this.props.user.name}</span>
                <span>{this.props.user.email}</span>
                <MiitComponents.UserListItemRoles user={this.props.user} onAction={this.props.onEdit}/>
            </div>
        );
    }
});