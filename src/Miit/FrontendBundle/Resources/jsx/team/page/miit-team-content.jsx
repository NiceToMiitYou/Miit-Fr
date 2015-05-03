MiitComponents.MiitTeamContent = React.createClass({
  render: function() {
    return (
        <div className="page-content page-dashboard">
            <div className="container">
                <h1 className="pt25">Configuration - Miitic <a className="miit-title-edit"><i className="fa fa-pencil"></i></a></h1>
                <div classNmae="dropdown">
                    <ul>
                        <li>Ouvert</li>
                        <li>Fermer</li>
                        <li>Supprimer</li>
                    </ul>
                </div>
                <p className="mt10 mb30"><i className="fa fa-circle-thin pull-left stat-open"></i> Votre Miit est ouvert est prêt à être utilisé</p>

                <div className="panel" >
                    <h2 className="panel-title"><i className="fa fa-lock pull-left "></i> Confidentialité</h2>
                    <div className="panel-content">
                        <div className="mb30">
                            <div className="checkbox-field mb20 ">
                                <label>
                                    <input type="radio" name="confid" className="option-input radio" defaultChecked={true} />
                                    Publique
                                </label>
                            </div>
                            <p className="mb10">Votre Miit est publique et accessible a tout le monde via l URL :</p>
                            <div className="input-field left-icon pure-u-sm-1-3">
                                <i className="fa fa-link"></i>
                                <input value="https://sncf.miit.fr/XBM56T" type="text" disabled />
                            </div>
                        </div>

                        <div className="checkbox-field mb20">
                            <label>
                                <input type="radio" name="confid" className="option-input radio" />
                                Privé
                            </label>
                        </div>

                        <p className="mb10">Votre Miit est privé et ne sera accessible qu aux personnes de votre choix</p>

                        <div>
                            <MiitComponents.UserList autoload={true} />
                        </div>

                        
                    </div>
                </div>
                
                <div className="panel" >
                    <h2 className="panel-title">Applications</h2>
                    <div className="panel-content">
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
        </div>
    );
  }
});
