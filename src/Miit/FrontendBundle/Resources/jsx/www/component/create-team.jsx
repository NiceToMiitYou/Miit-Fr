(function(){
    var Utils, UserRequest;

    function getDomainName(hostName)
    {
        return hostName.substring(hostName.lastIndexOf('.', hostName.lastIndexOf('.') - 1) + 1);
    }

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
                invalid_email: false,
                invalid_team:  false
            };
        },

        componentWillMount: function() {
            if(!Utils) {
                Utils = MiitApp.get('miit-utils');
            }
            if(!UserRequest) {
                UserRequest = MiitApp.get('miit-user-request');
            }
        },

        handleSubmit: function(e) {
            e.preventDefault();

            var email = React.findDOMNode(this.refs.email).value.trim();
            var team  = React.findDOMNode(this.refs.team).value.trim();

            this.setState(this.getDefaultErrors());

            // Check if there is data
            if (!email || !team) {
                this.setState({
                    missing_email: !email,
                    missing_team:  !team
                });
                return;
            }

            // Check if this is a correct email
            if(!Utils.validator.email(email)) {
                this.setState({
                    invalid_email: true
                });
                return;
            }

            // Check if this is a correct team name
            if(!Utils.validator.team(team)) {
                this.setState({
                    invalid_team: true
                });
                return;
            }

            UserRequest.registration(email, team, function(data) {
                if(data.done) {
                    /** Redirect the user to the team
                    var scheme = window.location.protocol + '//';
                    var domain = getDomainName(window.location.host);

                    var url = scheme + data.slug + '.' + domain;

                    window.location = url;
                    */
                }   
            });

            return;
        },

        render: function() {
            var classes_email = classNames({
                'invalid': this.state.missing_email ||
                           this.state.invalid_email
            });

            var classes_team = classNames({
                'invalid':  this.state.missing_team ||
                            this.state.invalid_team
            });

            return (
                <form className="miit-component create-team" onSubmit={this.handleSubmit}>
                    
                    <div className="row pt20 pb20">
                        <div className="col-md-6 mb10">
                            <div className="input-field left-icon icon-transparent push0">
                                <i className="fa fa-envelope-o"></i>
                                <input type="text" className={classes_email} placeholder={this.props.placeholder.email} ref="email" />
                            </div>
                        </div>

                        <div className="col-md-6">
                            <div className="input-field left-icon icon-transparent col5">
                                <i className="fa fa-users"></i>
                                <input type="text" className={classes_team}  placeholder={this.props.placeholder.team}  ref="team" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" className="btn btn-dark mt5">{this.props.submit}</button>
                
                </form>
            );
        }
    });
})();