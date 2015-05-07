(function(){
    MiitComponents.MiitContent = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    configuration: 'Configuration',
                    applications:  'Applications',
                    access:        'Accès'
                }
            };
        },

        render: function() {
            return (
                <div className="page-content page-dashboard">
                    <div className="container">
                        <h1 className="pt25">{this.props.text.configuration} - Miitic <a className="miit-title-edit"><i className="fa fa-pencil"></i></a></h1>
                        <div className="dropdown">
                           {/* <ul>
                                <li>Ouvert</li>
                                <li>Fermer</li>
                                <li>Supprimer</li>
                            </ul> */}
                        </div>
                        <p className="mt10 mb30"><i className="fa fa-circle-thin pull-left stat-open"></i> Votre Miit est ouvert est prêt à être utilisé</p>

                        
                        <div className="panel mb30" >
                            <h2 className="panel-title"><i className="fa fa-th pull-left "></i> {this.props.text.applications}</h2>
                            <div className="panel-content">
                                <div className="row">
                                    <ul className="app-list">

                                        <li>
                                            <a>
                                                <i className="fa fa-weixin bg-blue"></i>
                                                <span>Chat</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a>
                                                <i className="fa fa-question bg-green"></i>
                                                <span>Quizz</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a className="add-app">
                                                <i className="fa fa-plus bg-blue-grey"></i>
                                                <span>Ajouter une App</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div className="panel" >
                            <h2 className="panel-title"><i className="fa fa-exchange pull-left "></i> {this.props.text.access}</h2>
                            <div className="panel-content">
                                <h3><i className="fa fa-lock pull-left"></i> Confidentialité</h3>
                                <MiitComponents.MiitPublicPrivate />

                                <h3 className="mt40 mb10"><i className="fa fa-users pull-left"></i> Liste des utilisateurs</h3>
                                <MiitComponents.UserList autoload={true} />                 
                            </div>
                        </div>
                        
                    </div>
                </div>
            );
        }
    });
})();
