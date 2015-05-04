MiitComponents.MiitPublicPrivate = React.createClass({
   getDefaultProps: function() {
        return {
            text: {
                public:    'Publique',
                isPublic:  'Votre Miit est publique et accessible a tout le monde via l\'URL suivante',
                private:   'Privé',
                isPrivate: 'Votre Miit est privé et ne sera accessible qu\'aux personnes de votre choix'
            },
            miit: {
                id:     '',
                token:  'MiitTest',
                public: false
            }
        };
    },

    getInitialState: function() {
        return { 
            miit: this.props.miit
        };
    },

    onChange: function(isPublic, e) {
        this.setState({
            miit: {
                public: isPublic
            }
        });
    },

    generateUrl: function() {        
        var url = window.location.protocol + '//' + window.location.hostname + '/m/';

        return url + this.props.miit.token;
    },

    render: function() {

        return (
            <div className="miit-component miit-public-private mt20">
                <div className="checkbox-field mb20">
                    <label>
                        <input type="radio" name="confid" className="option-input radio" defaultChecked={this.state.miit.public} onChange={this.onChange.bind(this, true)} />
                        {this.props.text.public}
                    </label>
                    <label className="ml40">
                        <input type="radio" name="confid" className="option-input radio" defaultChecked={!this.state.miit.public} onChange={this.onChange.bind(this, false)}/>
                        {this.props.text.private}
                    </label>
                </div>

                <If test={this.state.miit.public}>
                    <div className="row mb20">
                        <p className="mb10">{this.props.text.isPublic}</p>
                        
                        <div className="col8 col16-md">
                            <div className="input-field left-icon">
                                <i className="fa fa-link"></i>
                                <input value={this.generateUrl()} type="text" disabled />
                            </div>
                        </div>
                    </div>
                </If>

                
                <If test={!this.state.miit.public}>
                    <p className="mb10">{this.props.text.isPrivate}</p>
                </If>
            </div>
        );
    }
});