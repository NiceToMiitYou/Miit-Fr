(function(){
    var Utils, NewsLetterRequest;

    MiitComponents.NewsLetter = React.createClass({
        getDefaultProps: function() {
            return {
                placeholder: {
                    email: MiitTranslator.get('placeholder.your.email', 'inputs')
                },
                submit: MiitTranslator.get('submit.subscribe.newsletter', 'inputs')
            };
        },

        getInitialState: function() {

            return this.getDefaultErrors();
        },

        getDefaultErrors: function() {
            return {
                missing_email: false,
                invalid_email: false
            };
        },

        componentWillMount: function() {
            if(!Utils) {
                Utils = MiitApp.get('miit-utils');
            }
            if(!NewsLetterRequest) {
                NewsLetterRequest = MiitApp.get('miit-news-letter-request');
            }
        },

        handleSubmit: function(e) {
            e.preventDefault();

            var email = React.findDOMNode(this.refs.email).value.trim();

            this.setState(this.getDefaultErrors());

            // Check if there is data
            if (!email) {
                this.setState({
                    missing_email: !email
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

            NewsLetterRequest.registration(email, function(data) {
                if(data.done) {
                    console.log('Thanks');
                }
            });

            return;
        },

        render: function() {
            var classes_email = classNames({
                'invalid': this.state.missing_email ||
                           this.state.invalid_email
            });

            return (
                <form className="miit-component news-letter" onSubmit={this.handleSubmit}>
                    
                    <div className="row pt20 pb20">
                        <div className="col-md-8 mb10">
                            <div className="input-field left-icon icon-transparent push0">
                                <i className="fa fa-envelope-o"></i>
                                <input type="text" className={classes_email} placeholder={this.props.placeholder.email} ref="email" />
                            </div>
                        </div>
                        <div className="col-md-4 mb10">
                            <button type="submit" className="btn btn-dark pt10 pb10">{this.props.submit}</button>
                        </div>
                    </div>
                </form>
            );
        }
    });
})();