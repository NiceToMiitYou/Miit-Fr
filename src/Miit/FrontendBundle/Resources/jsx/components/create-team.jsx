MiitComponents.CreateTeam = React.createClass({

    getInitialState: function() {

        return {
            placeholder: {
                email: MiitTranslator.get('placeholder.your.email', 'inputs'),
                team:  MiitTranslator.get('placeholder.team.name',  'inputs')
            },
            submit: MiitTranslator.get('submit.create.team', 'inputs')    
        }
    },

    handleSubmit: function(e) {
        e.preventDefault();

        var email = React.findDOMNode(this.refs.email).value.trim();
        var team  = React.findDOMNode(this.refs.team).value.trim();
        
        // Check if there is data
        if (!email || !team) {
            return;
        }

        // Check if this is a correct email
        if(!MiitUtils.validator.email(email)) {
            return;
        }

        // Check if this is a correct team name
        if(!MiitUtils.validator.team(team)) {
            return;
        }


        return;
    },

    render: function() {

        return (
            <form class="miit-component create-team" onSubmit={this.handleSubmit}>
                <div>
                    <input type="text" placeholder={this.state.placeholder.email} ref="email" />
                    <input type="text" placeholder={this.state.placeholder.team}  ref="team" />
                    <input type="submit" value={this.state.submit} />
                </div>
            </form>
        );
    }
});