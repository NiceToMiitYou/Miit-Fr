(function(){
    var TeamStore;

    MiitComponents.MenuHeader = React.createClass({
        componentWillMount: function() {
            if(!TeamStore) {
                TeamStore = MiitApp.get('miit-team-store');
            }
        },

        componentDidMount: function() {
            TeamStore.addTeamUpdatedListener(this._onChanged);
        },

        componentWillUnmount: function() {
            TeamStore.removeTeamUpdatedListener(this._onChanged);
        },

        _onChanged: function() {
            this.forceUpdate();
        },

        render: function() {
            var team = TeamStore.getTeam();

            return (
                <Link href="#/settings" className="miit-component menu-header sl-header">
                    {team.name} <i className="fa fa-cogs pull-right"></i>
                </Link>
            );
        }
    });
})();