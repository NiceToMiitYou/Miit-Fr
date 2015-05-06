(function(){
    var Storage;

    MiitComponents.MiitUserSettings = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    informations: 'Informations'
                }  
            };
        },

        componentWillMount: function() {
            if(!Storage) {
                Storage = MiitApp.get('miit-storage');
            }
        },

        render: function() {
            var user = Storage.shared.get('user');

            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{user.name}</h1>
                        
                        <div className="panel mb30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i>{this.props.text.informations}</h2>
                            <div className="panel-content">
                                <div className="row">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            );
        }
    });
})();