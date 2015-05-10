(function(){
    var Utils, TeamActions, TeamStore;

    MiitComponents.TeamUpdate = React.createClass({
        getDefaultProps: function() {
            return {
                placeholder: {
                    name: "Nom de l'équipe"
                },
                submit: "Modifier"
            };
        },

        getInitialState: function() {
            var initial = this.getDefaultErrors();

            initial.value_name = '';

            return initial;
        },

        getDefaultErrors: function() {
            return {
                missing_name:   false,
                invalid_same:   false,
                invalid_format: false
            };
        },
        
        componentWillMount: function() {
            if(!Utils) {
                Utils = MiitApp.get('miit-utils');
            }
            if(!TeamStore) {
                TeamStore = MiitApp.get('miit-team-store');
            }
            if(!TeamActions) {
                TeamActions = MiitApp.get('miit-team-actions');
            }
        },

        componentDidMount: function() {
            TeamStore.addTeamUpdatedListener(this._onChanged);
            TeamStore.addTeamNotUpdatedListener(this._onError);
        },

        componentWillUnmount: function() {
            TeamStore.removeTeamUpdatedListener(this._onChanged);
            TeamStore.removeTeamNotUpdatedListener(this._onError);
        },

        _onChanged: function() {
            if(this.isMounted()) {
                // Reset value
                this.setState({
                    value_name: ''
                });
            }
        },

        _onError: function() {
            console.log('team not updated.');
        },
        
        handleChange: function(e) {
            if(e.target && e.target.name) {
                var update = {};
                var name   = 'value_' + e.target.name;
                var value  = e.target.value || '';

                update[name] = value;

                this.setState(update);
            }
        },

        handleSubmit: function(e) {
            e.preventDefault();

            var name = this.state.value_name;
            var team = TeamStore.getTeam();
            
            this.setState(this.getDefaultErrors());

            // Check if there is data
            if (!name) {
                this.setState({
                    missing_name: !name
                });
                return;
            }

            // Check if the old is the same as the old
            if(name === team.name) {
                this.setState({
                    invalid_same: true
                });
                return;
            }

            // Check if this is a correct format
            if(!Utils.validator.team(name)) {
                this.setState({
                    invalid_format: true
                });
                return;
            }

            TeamActions.update(name);

            return;
        },

        render: function() {
            var value_name   = this.state.value_name;
            var classes_name = classNames({
                'invalid': this.state.missing_name ||
                           this.state.invalid_same ||
                           this.state.invalid_format
            });

            return (
                <form className="miit-component user-update" onSubmit={this.handleSubmit}>
                    <div>
                        <input type="text" className={classes_name} value={value_name} placeholder={this.props.placeholder.name} onChange={this.handleChange} name="name" />
                        <input type="submit" value={this.props.submit} />           
                    </div>
                </form>
            );
        }
    });
})();