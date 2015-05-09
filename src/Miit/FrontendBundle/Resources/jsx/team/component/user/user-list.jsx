(function(){
    var TeamStore, TeamActions;

    MiitComponents.UserList = React.createClass({
        getDefaultProps: function() {
            return {
                users:    [],
                loading:  MiitTranslator.get('loading', 'team')
            };
        },

        getInitialState: function() {
            return {
                users:  [],
                loaded: false
            };
        },

        componentWillMount: function() {
            if(!TeamStore) {
                TeamStore = MiitApp.get('miit-team-store');
            }
            if(!TeamActions) {
                TeamActions = MiitApp.get('miit-team-actions');
            }
        },

        componentDidMount: function() {
            // Invited
            TeamStore.addInvitedListener(this._refresh);
            // Promoted
            TeamStore.addPromotedListener(this._refresh);
            // Demoted
            TeamStore.addDemotedListener(this._refresh);
            // Removed
            TeamStore.addRemovedListener(this._refresh);
            // Refresh
            TeamStore.addRefreshedListener(this._refresh);
            // Refresh the list
            TeamActions.refresh();
        },

        componentWillUnmount: function() {
            // Invited
            TeamStore.removeInvitedListener(this._refresh);
            // Promoted
            TeamStore.removePromotedListener(this._refresh);
            // Demoted
            TeamStore.removeDemotedListener(this._refresh);
            // Removed
            TeamStore.removeRemovedListener(this._refresh);
            // Refresh
            TeamStore.removeRefreshedListener(this._refresh);
        },

        _refresh: function() {
            if(this.isMounted()) {
                this.setState({
                    users:  TeamStore.getUsers().sortBy('name'),
                    loaded: true
                });
            }
        },

        render: function() {
            var loadingElement = null;

            if(this.state.loaded === false) {
                loadingElement = (<div>{this.props.loading}</div>);
            }

            return (
                <div className="miit-component user-list">
                    <MiitComponents.UserListHeader />
                    {this.state.users.map(function(user) {
                        return <MiitComponents.UserListItem key={user.id} user={user} />;
                    }.bind(this))}
                    {loadingElement}
                    <MiitComponents.UserListInvite onInvite={this.allowRefresh} />
                </div>
            );
        }
    });
})();