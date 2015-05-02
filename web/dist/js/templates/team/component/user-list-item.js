MiitComponents.UserListItem = React.createClass({displayName: "UserListItem",
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
            React.createElement("div", {className: "miit-component user-list-item"}, 
                React.createElement("span", null, this.props.user.name), 
                React.createElement(MiitComponents.UserListItemRoles, {user: this.props.user, onAction: this.props.onEdit})
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list-item.js.map