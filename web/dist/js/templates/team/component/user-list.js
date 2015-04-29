MiitComponents.UserList = React.createClass({displayName: "UserList",
    getDefaultProps: function() {
        return {
            users:    [],
            autoload: false
        };
    },

    getInitialState: function() {
        return {
            loaded: false
        };
    },

    refresh: function() {
        if(this.props.autoload && !this.state.loaded ) {

            MiitApp.request.team.users(function(data){

                this.props.users = data;

                this.setState({
                    loaded: true
                });
            }.bind(this));
        }
    },

    allowRefresh: function() {
        this.setState({
            loaded: false
        });
    },

    render: function() {
        this.refresh();

        var loading = (this.props.autoload && !this.state.loaded)?(
            React.createElement("div", null, "Loading...")
        ) : null;

        return (
            React.createElement("div", {className: "miit-component user-list"}, 
                React.createElement(MiitComponents.UserListHeader, null), 
                this.props.users.map(function(user) {
                    return React.createElement(MiitComponents.UserListItem, {user: user});
                }), 
                loading, 
                React.createElement(MiitComponents.UserListInvite, {onInvite: this.allowRefresh})
            )
        );
    }
});
//# sourceMappingURL=../../team/component/user-list.js.map