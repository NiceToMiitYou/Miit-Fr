MiitComponents.ChangePassword = React.createClass({displayName: "ChangePassword",
    getDefaultProps: function() {
        return {
            placeholder: {
                old:    MiitTranslator.get('placeholder.your.password',   'inputs'),
                first:  MiitTranslator.get('placeholder.password.first',  'inputs'),
                second: MiitTranslator.get('placeholder.password.second', 'inputs')
            },
            submit: MiitTranslator.get('submit.change.password', 'inputs')
        };
    },

    getInitialState: function() {

        var initial = this.getDefaultErrors();

        initial['value_old']    = '';
        initial['value_first']  = '';
        initial['value_second'] = '';

        return initial;
    },

    getDefaultErrors: function() {
        return {
            missing_old:      false,
            missing_first:    false,
            missing_second:   false,
            invalid_old:      false,
            invalid_same:     false,
            invalid_repeated: false,
            invalid_format:   false
        };
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

        var old    = this.state.value_old;
        var first  = this.state.value_first;
        var second = this.state.value_second;
        
        this.setState(this.getDefaultErrors());

        // Check if there is data
        if (!old || !first || !second) {
            this.setState({
                missing_old:    !old,
                missing_first:  !first,
                missing_second: !second
            });
            return;
        }

        // Check if this is a correct repeated
        if(first !== second) {
            this.setState({
                invalid_repeated: true
            });
            return;
        }

        // Check if the old is the same as the old
        if(first === old) {
            this.setState({
                invalid_same: true
            });
            return;
        }

        // Check if this is a correct format
        if(!MiitApp.utils.validator.password(first)) {
            this.setState({
                invalid_format: true
            });
            return;
        }

        MiitApp.request.user.change_password(old, first, function(data) {

            // Reset value
            this.setState({
                value_old:    '',
                value_first:  '',
                value_second: ''
            });
        }.bind(this));

        return;
    },

    render: function() {
        var cx = React.addons.classSet;

        var value_old      = this.state.value_old;
        var classes_old    = cx({
            'invalid': this.state.missing_old ||
                       this.state.invalid_old
        });

        var value_first    = this.state.value_first;
        var classes_first  = cx({
            'invalid': this.state.missing_first ||
                       this.state.invalid_same  ||
                       this.state.invalid_format
        });

        var value_second   = this.state.value_second;
        var classes_second = cx({
            'invalid': this.state.missing_second ||
                       this.state.invalid_repeated
        });

        return (
            React.createElement("form", {className: "miit-component change-password", onSubmit: this.handleSubmit}, 
                React.createElement("div", null, 
                    React.createElement("input", {type: "password", className: classes_old, value: value_old, placeholder: this.props.placeholder.old, onChange: this.handleChange, name: "old"}), 
                    React.createElement("input", {type: "password", className: classes_first, value: value_first, placeholder: this.props.placeholder.first, onChange: this.handleChange, name: "first"}), 
                    React.createElement("input", {type: "password", className: classes_second, value: value_second, placeholder: this.props.placeholder.second, onChange: this.handleChange, name: "second"}), 
                    React.createElement("input", {type: "submit", value: this.props.submit})
                )
            )
        );
    }
});
//# sourceMappingURL=../../team/component/change-password.js.map