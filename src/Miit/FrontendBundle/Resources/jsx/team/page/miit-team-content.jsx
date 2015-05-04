MiitComponents.MiitTeamContent = React.createClass({
  render: function() {
    return (
        <div className="page-content page-dashboard">
            <div className="container">
                <h1 className="pt25">Configuration - Miitic <a className="miit-title-edit"><i className="fa fa-pencil"></i></a></h1>
                <div classNmae="dropdown">
                   {/* <ul>
                        <li>Ouvert</li>
                        <li>Fermer</li>
                        <li>Supprimer</li>
                    </ul> */}
                </div>
                <p className="mt10 mb30"><i className="fa fa-circle-thin pull-left stat-open"></i> Votre Miit est ouvert est prêt à être utilisé</p>

                
                <div className="panel mb30" >
                    <h2 className="panel-title"><i className="fa fa-th pull-left "></i> Applications</h2>
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
                    <h2 className="panel-title"><i className="fa fa-lock pull-left "></i> Accès</h2>
                    <div className="panel-content">
                        <MiitComponents.UserList autoload={true} />
                        
                        <MiitComponents.MiitPublicPrivate />                     
                    </div>
                </div>
                
            </div>
        </div>
    );
  }
});
