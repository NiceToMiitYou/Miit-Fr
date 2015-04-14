MiitComponents.CreateTeam = React.createClass({

    getInitialState: function() {

        return {
            placeholder: {
                email: MiitTranslator.get('placeholder.your.email', 'inputs'),
                team:  MiitTranslator.get('placeholder.team.name', 'inputs')
            },
            submit: MiitTranslator.get('submit.create.team', 'inputs'),
            errors: this.getDefaultErrors()
        }
    },

    getDefaultErrors: function() {
        return {
            missing_email: false,
            missing_team:  false,
            missing_terms: false,
            invalid_email: false,
            invalid_team:  false
        };
    },

    handleSubmit: function(e) {
        e.preventDefault();

        var email = React.findDOMNode(this.refs.email).value.trim();
        var team  = React.findDOMNode(this.refs.team).value.trim();
        var terms = React.findDOMNode(this.refs.terms).checked;
        
        // Check if there is data
        if (!email || !team || !terms) {
            this.setState({ errors: {
                missing_email: !email,
                missing_team:  !team,
                missing_terms: !terms
            }});
            return;
        }

        // Check if this is a correct email
        if(!MiitUtils.validator.email(email)) {
            this.setState({ errors: {
                invalid_email: true
            }});
            return;
        }

        // Check if this is a correct team name
        if(!MiitUtils.validator.team(team)) {
            this.setState({ errors: {
                invalid_team: true
            }});
            return;
        }

        this.setState({
            errors: this.getDefaultErrors()
        });

        // Request for CRSF
        MiitUtils.ajax.crsf('registration', function(token) {

            // Register the user
            MiitUtils.ajax.send('/register', {
                'registration_type[user][email]': email,
                'registration_type[team][name]':  team,
                'registration_type[terms]':       terms,
                'registration_type[_token]':      token
            }, function(data) {
                console.log(data);    
            });
        });

        return;
    },

    render: function() {
        var cx = React.addons.classSet;

        var classes_email = cx({
            'invalid': this.state.errors.missing_email ||
                       this.state.errors.invalid_email
        });

        var classes_team = cx({
            'invalid':  this.state.errors.missing_team ||
                        this.state.errors.invalid_team
        });

        var classes_terms = cx({
            'invalid': this.state.errors.missing_terms
        });

        return (
            <form class="miit-component create-team" onSubmit={this.handleSubmit}>
                <div>
                    <input type="text" className={classes_email} placeholder={this.state.placeholder.email} ref="email" />
                    <input type="text" className={classes_team}  placeholder={this.state.placeholder.team}  ref="team" />
                    <input type="checkbox" className={classes_terms} ref="terms" />
                    <input type="submit" value={this.state.submit} />
                </div>
            </form>
        );
    }
});