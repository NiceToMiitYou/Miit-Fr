MiitComponents.UserListInvite = React.createClass({
    getDefaultProps: function() {
        return {
            placeholder: {
                email: MiitTranslator.get('placeholder.email.invite', 'inputs')
            },
            submit: MiitTranslator.get('submit.invite.user', 'inputs')
        };
    },

    getInitialState: function() {
        var initial = this.getDefaultErrors();

        initial['email'] = '';

        return initial;
    },

    getDefaultErrors: function() {
        return {
            missing_email: false,
            invalid_email: false
        };
    },
    
    handleChange: function(newValue) {
        this.setState({
            email: newValue.trim()
        });
    },

    handleSubmit: function(e) {
        e.preventDefault();

        var email = this.state.email;
        
        this.setState(this.getDefaultErrors());

        // Check if this is an admin
        if(!MiitApp.utils.user.isAdmin()){
            return;
        }

        // Check if there is data
        if (!email) {
            this.setState({
                missing_email: true
            });
            return;
        }

        // Check if this is a correct format
        if(!MiitApp.utils.validator.email(email)) {
            this.setState({
                invalid_email: true
            });
            return;
        }

        MiitApp.requests.team.invite(email, function(data) {
            this.setState({
                email: ''
            });

            if(typeof this.props.onInvite === 'function') {
                this.props.onInvite(email);
            }
        }.bind(this));

        return;
    },

    render: function() {
        // Check if this is an admin
        if(!MiitApp.utils.user.isAdmin()){
            return null;
        }

        var cx = React.addons.classSet;

        var classes_invalid = cx({
            'invalid': this.state.missing_email ||
                       this.state.invalid_email
        });

        var valueLinkEmail  = {
            value:         this.state.email,
            requestChange: this.handleChange
        };

        return (
            <div className="miit-component user-list-invite mt20">
                <form onSubmit={this.handleSubmit}>

                    <div className="input-field left-icon col7 col16-sm">
                        <i className="fa fa-user-plus"></i>
                        <input type="text" className={classes_invalid} placeholder={this.props.placeholder.email} valueLink={valueLinkEmail} />
                    </div>

                    <button type="submit" className="btn btn-info btn-large ml15">{this.props.submit}</button>
                </form>
            </div>
        );
    }
});