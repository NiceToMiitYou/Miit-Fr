(function(){
    var TeamRequest;

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
                loaded: false,
                users:  this.props.users
            };
        },

        componentWillMount: function() {
            if(!TeamRequest) {
                TeamRequest = MiitApp.get('miit-team-request');
            }
        },

        refresh: function() {
            if(this.props.autoload && !this.state.loaded ) {

                TeamRequest.users(function(data){

                    if(this.isMounted()) {
                        this.setState({
                            loaded: true,
                            users: data
                        });
                    }
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
                    {this.state.users.map(function(user) {
                        return <MiitComponents.UserListItem key={user.id} user={user} onEdit={this.allowRefresh} />;
                    }.bind(this))}
                    {loadingElement}
                    <MiitComponents.UserListInvite onInvite={this.allowRefresh} />
                </div>
            );
        }
    });
})();