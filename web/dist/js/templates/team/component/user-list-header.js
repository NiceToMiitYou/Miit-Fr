MiitComponents.UserListHeader = React.createClass({displayName: "UserListHeader",
    getDefaultProps: function() {
        return {
            title: {
                name:   'Name',
                action: 'Action'
            }
        };
    },

    render: function() {
        var actionElement = null;

        // Check if this is an admin
        if(MiitApp.utils.user.isAdmin()){
            actionElement = (React.createElement("span", null, this.props.title.action));
        }

        return (
            React.createElement("div", {className: "miit-component user-list-header"}, 
                React.createElement("span", null, this.props.title.name), 
                actionElement
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list-header.js.map