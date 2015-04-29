MiitComponents.UserList = React.createClass({
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
            <div>Loading...</div>
        ) : null;

        return (
            <div className="miit-component user-list">
                <MiitComponents.UserListHeader />
                {this.props.users.map(function(user) {
                    return <MiitComponents.UserListItem user={user} />;
                })}
                {loading}
                <MiitComponents.UserListInvite onInvite={this.allowRefresh} />
            </div>
        );
    }
});