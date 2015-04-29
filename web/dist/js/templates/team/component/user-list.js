MiitComponents.UserList = React.createClass({displayName: "UserList",
    getDefaultProps: function() {
        return {
            users: []
        };
    },

    render: function() {
        return (
            React.createElement("div", {className: "miit-component user-list"}, 
                React.createElement(MiitComponents.UserListHeader, null), 
                this.props.users.map(function(user) {
                    return React.createElement(MiitComponents.UserListItem, {user: user});
                })
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list.js.map