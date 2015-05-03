MiitComponents.CreateTeam = React.createClass({
    getDefaultProps: function() {
        return {
            placeholder: {
                email: MiitTranslator.get('placeholder.your.email', 'inputs'),
                team:  MiitTranslator.get('placeholder.team.name',  'inputs')
            },
            submit: MiitTranslator.get('submit.create.team', 'inputs')
        };
    },

    getInitialState: function() {

        return this.getDefaultErrors();
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

        this.setState(this.getDefaultErrors());

        // Check if there is data
        if (!email || !team || !terms) {
            this.setState({
                missing_email: !email,
                missing_team:  !team,
                missing_terms: !terms
            });
            return;
        }

        // Check if this is a correct email
        if(!MiitApp.utils.validator.email(email)) {
            this.setState({
                invalid_email: true
            });
            return;
        }

        // Check if this is a correct team name
        if(!MiitApp.utils.validator.team(team)) {
            this.setState({
                invalid_team: true
            });
            return;
        }

        // Request for CRSF
        MiitApp.request.user.registration(email, team, function(data) {
            console.log(data);    
        });

        return;
    },

    render: function() {
        var cx = React.addons.classSet;

        var classes_email = cx({
            'invalid': this.state.missing_email ||
                       this.state.invalid_email
        });

        var classes_team = cx({
            'invalid':  this.state.missing_team ||
                        this.state.invalid_team
        });

        var classes_terms = cx({
            'invalid': this.state.missing_terms
        });

        return (
            <form className="miit-component create-team" onSubmit={this.handleSubmit}>
                <div className="wrapper">

                    <div className="col1"></div>

                    <div className="input-field col5 push0">
                        <i className="fa fa-envelope-o"></i>
                        <input type="text" className={classes_email} placeholder={this.props.placeholder.email} ref="email" />
                    </div>

                    <div className="col1"></div>

                    <div className="input-field col5">
                        <i className="fa fa-users"></i>
                        <input type="text" className={classes_team}  placeholder={this.props.placeholder.team}  ref="team" />
                    </div>

                    <div className="col1"></div>

                    <button type="submit" className="btn btn-dark mt5">{this.props.submit}</button>
                </div>
            </form>
        );
    }
});