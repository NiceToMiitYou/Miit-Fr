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

    shouldComponentUpdate: function(nextProps, nextState) {
        return nextProps.user.name !== this.props.user.name;
    },

    render: function() {

        return (
            <div className="miit-component user-list-item">
                <span>{this.props.user.name}</span>
                <MiitComponents.UserListItemRoles user={this.props.user} onAction={this.props.onEdit}/>
            </div>
        );
    }
});