window.MiitTeamHomePage = React.createClass({
  render: function() {
    return (<div className="page bg-grey lighten-5">

      <div className="sidr-left bg-blue-grey">
        <div className="sl-wrapper">
          <a className="sl-header bg-blue-grey darken-1">
            <i className="fa fa-bars pull-left"></i>
            Menu
            <i className="fa fa-angle-down pull-right"></i>
          </a>

          <span className="sl-label"><i className="mdi-action-favorite pull-left"></i> Favorites</span>

          <ul className="sl-list">
            <li><a><i className="fa fa-weixin pull-left"></i>Chat miit</a></li>
            <li><a><i className="fa fa-question pull-left"></i>Quizz : Que pensez-vous...</a></li>
          </ul>

          <span className="sl-label"><i className="fa fa-map-marker pull-left"></i> Miits</span>

          <ul className="sl-list">
            <li><a className="active"><i className="fa fa-circle-thin pull-left stat-open"></i> Miit ouvert</a></li>
            <li><a><i className="fa fa-circle-thin pull-left stat-ready"></i> Miit prêt</a></li>
            <li><a><i className="fa fa-circle-thin pull-left stat-config"></i> Miit en configuration</a></li>
            <li><a><i className="fa fa-plus pull-left"></i> Créer un Miit</a></li>
          </ul>

          <a className="sl-footer">
            <div className="avatar border-circle"><img src="http://www.mangashare.com/forums/customavatars/avatar68124_1.gif"/></div>
            <span>John Random
              <i className="fa fa-angle-up pull-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div className="main">
        <div className="page-header z-depth-1">
          <h1><i className="fa fa-circle-thin pull-left stat-open"></i> Miit ouvert <a className="ph-title"><i className="fa fa-cog pull-right"></i></a></h1>
          <ul className="ph-btn-list">
            <li className="active"><a><i className="fa fa-question pull-left"></i>Quizz <span>Que pensez-vous de...</span> <i className="fa fa-times pull-right"></i></a></li>
            <li><a><i className="fa fa-weixin"></i>Chat<i className="fa fa-times pull-right"></i></a></li>
            <li><a><i className="fa fa-plus pull-left"></i> Ajouter</a></li>
          </ul>
        </div>
        <div className="page-content page-dashboard">
          <div className="container">
            <h1 className="mb30">Dashboard</h1>

            <h2>Configuration</h2>

            <h3 className="mt30 mb30"><i className="fa fa-lock pull-left "></i> Confidentialité</h3>
            <div className="mb20">
                <div className="checkbox-field mb20">
                  <label>
                    <input type="radio" name="confid" className="option-input radio" checked />
                    Publique
                  </label>
              </div>
              <p className="mb10">Votre Miit est publique et accessible a tout le monde via l URL :</p>
              <div className="input-field pure-u-sm-1-3 mb20">
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

            <div className="input-field pure-u-sm-1-3">
              <i className="fa fa-user-plus"></i>
              <input placeholder="Ajoutez une personne ou un cercle" type="text" />
            </div>


            <h3 className="mt30 mb30"><i className="fa fa-info pull-left "></i> Informations</h3>

                <div className="input-field pure-u-sm-1-2 mb30">
                  <label>Titre</label>
                  <input placeholder="Titre" id="title" type="text" value="Miit ouvert" />
                </div>

                <div className="input-field pure-u-sm-2-3">
                  <label>Description</label>
                  <textarea placeholder="Description" rows="6">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </textarea>
                </div>

            <h3 className="mt30"><i className="fa fa-circle-thin pull-left stat-open"></i> Status</h3>
            <p className="mt30 mb30"><i className="fa fa-info pull-left"></i> Votre Miit est ouvert est prêt à être utilisé</p>
            <button className="btn mr20">Ouvert</button><button className="btn btn-warning mr20">Fermer</button><button className="btn btn-danger mr20">Supprimer</button>

            <h2 className="mt30">Applications</h2>
          </div>
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

    </div>);
  }
});