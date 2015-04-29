MiitComponents.UserListItem = React.createClass({displayName: "UserListItem",
    getDefaultProps: function() {
        return {
            user: {
                name:  'unknow',
                roles: []
            }
        };
    },

    shouldComponentUpdate: function(nextProps, nextState) {
        return nextProps.user.id !== this.props.user.id;
    },

    render: function() {
        return (
            React.createElement("div", {className: "miit-component user-list-item"}, 
                React.createElement("span", null, this.props.user.name)
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list-item.js.map