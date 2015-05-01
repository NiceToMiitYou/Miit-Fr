MiitComponents.UserList = React.createClass({
    getDefaultProps: function() {
        return {
            users:    [],
            autoload: false,
            loading:  MiitTranslator.get('loading', 'team')
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

        var loadingElement = null;

        if(this.props.autoload && !this.state.loaded) {
            loadingElement = (<div>{this.props.loading}</div>);
        }

        return (
            <div className="miit-component user-list">
                <MiitComponents.UserListHeader />
                {this.props.users.map(function(user) {
                    return <MiitComponents.UserListItem user={user} />;
                })}
                {loadingElement}
                <MiitComponents.UserListInvite onInvite={this.allowRefresh} />
            </div>
        );
    }
});