MiitComponents.UserListHeader = React.createClass({displayName: "UserListHeader",
    getDefaultProps: function() {
        return {
            title: {
                name: 'Name'
            }
        };
    },

    render: function() {
        return (
            React.createElement("div", {className: "miit-component user-list-header"}, 
                React.createElement("span", null, this.props.title.name)
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list-header.js.map