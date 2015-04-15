window.MiitTeamHomePage = React.createClass({displayName: "MiitTeamHomePage",
  render: function() {
    return (React.createElement("div", {className: "page bg-grey lighten-5"}, 

      React.createElement("div", {className: "sidr-left bg-blue-grey"}, 
        React.createElement("div", {className: "sl-wrapper"}, 
          React.createElement("a", {className: "sl-header bg-blue-grey darken-1"}, 
            React.createElement("i", {className: "fa fa-bars pull-left"}), 
            "Menu", 
            React.createElement("i", {className: "fa fa-angle-down pull-right"})
          ), 

          React.createElement("span", {className: "sl-label"}, React.createElement("i", {className: "mdi-action-favorite pull-left"}), " Favorites"), 

          React.createElement("ul", {className: "sl-list"}, 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-weixin pull-left"}), "Chat miit")), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-question pull-left"}), "Quizz : Que pensez-vous..."))
          ), 

          React.createElement("span", {className: "sl-label"}, React.createElement("i", {className: "fa fa-map-marker pull-left"}), " Miits"), 

          React.createElement("ul", {className: "sl-list"}, 
            React.createElement("li", null, React.createElement("a", {className: "active"}, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-open"}), " Miit ouvert")), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-ready"}), " Miit prêt")), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-config"}), " Miit en configuration")), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-plus pull-left"}), " Créer un Miit"))
          ), 

          React.createElement("a", {className: "sl-footer"}, 
            React.createElement("div", {className: "avatar border-circle"}, React.createElement("img", {src: "http://www.mangashare.com/forums/customavatars/avatar68124_1.gif"})), 
            React.createElement("span", null, "John Random", 
              React.createElement("i", {className: "fa fa-angle-up pull-right"})
            )
          )
        )
      ), 

      React.createElement("div", {className: "main"}, 
        React.createElement("div", {className: "page-header z-depth-1"}, 
          React.createElement("h1", null, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-open"}), " Miit ouvert ", React.createElement("a", {className: "ph-title"}, React.createElement("i", {className: "fa fa-cog pull-right"}))), 
          React.createElement("ul", {className: "ph-btn-list"}, 
            React.createElement("li", {className: "active"}, React.createElement("a", null, React.createElement("i", {className: "fa fa-question pull-left"}), "Quizz ", React.createElement("span", null, "Que pensez-vous de..."), " ", React.createElement("i", {className: "fa fa-times pull-right"}))), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-weixin"}), "Chat", React.createElement("i", {className: "fa fa-times pull-right"}))), 
            React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-plus pull-left"}), " Ajouter"))
          )
        ), 
        React.createElement("div", {className: "page-content page-dashboard"}, 
          React.createElement("div", {className: "container"}, 
            React.createElement("h1", {className: "mb30"}, "Dashboard"), 

            React.createElement("h2", null, "Configuration"), 

            React.createElement("h3", {className: "mt30 mb30"}, React.createElement("i", {className: "fa fa-lock pull-left "}), " Confidentialité"), 
            React.createElement("div", {className: "mb20"}, 
                React.createElement("div", {className: "checkbox-field mb20"}, 
                  React.createElement("label", null, 
                    React.createElement("input", {type: "radio", name: "confid", className: "option-input radio", checked: true}), 
                    "Publique"
                  )
              ), 
              React.createElement("p", {className: "mb10"}, "Votre Miit est publique et accessible a tout le monde via l URL :"), 
              React.createElement("div", {className: "input-field pure-u-sm-1-3 mb20"}, 
                React.createElement("input", {value: "https://sncf.miit.fr/XBM56T", type: "text", disabled: true})
              )
            ), 

              React.createElement("div", {className: "checkbox-field mb20"}, 
                React.createElement("label", null, 
                  React.createElement("input", {type: "radio", name: "confid", className: "option-input radio"}), 
                  "Privé"
                )
            ), 

            React.createElement("p", {className: "mb10"}, "Votre Miit est privé et ne sera accessible qu aux personnes de votre choix"), 

            React.createElement("div", {className: "input-field pure-u-sm-1-3"}, 
              React.createElement("i", {className: "fa fa-user-plus"}), 
              React.createElement("input", {placeholder: "Ajoutez une personne ou un cercle", type: "text"})
            ), 


            React.createElement("h3", {className: "mt30 mb30"}, React.createElement("i", {className: "fa fa-info pull-left "}), " Informations"), 

                React.createElement("div", {className: "input-field pure-u-sm-1-2 mb30"}, 
                  React.createElement("label", null, "Titre"), 
                  React.createElement("input", {placeholder: "Titre", id: "title", type: "text", value: "Miit ouvert"})
                ), 

                React.createElement("div", {className: "input-field pure-u-sm-2-3"}, 
                  React.createElement("label", null, "Description"), 
                  React.createElement("textarea", {placeholder: "Description", rows: "6"}, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ")
                ), 

            React.createElement("h3", {className: "mt30"}, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-open"}), " Status"), 
            React.createElement("p", {className: "mt30 mb30"}, React.createElement("i", {className: "fa fa-info pull-left"}), " Votre Miit est ouvert est prêt à être utilisé"), 
            React.createElement("button", {className: "btn mr20"}, "Ouvert"), React.createElement("button", {className: "btn btn-warning mr20"}, "Fermer"), React.createElement("button", {className: "btn btn-danger mr20"}, "Supprimer"), 

            React.createElement("h2", {className: "mt30"}, "Applications")
          ), 
          React.createElement("ul", {className: "app-list"}, 

            React.createElement("li", null, 
              React.createElement("a", null, 
                React.createElement("i", {className: "fa fa-weixin bg-blue"}), 
                React.createElement("span", null, "Chat")
              )
            ), 

            React.createElement("li", null, 
              React.createElement("a", null, 
                React.createElement("i", {className: "fa fa-question bg-green"}), 
                React.createElement("span", null, "Quizz")
              )
            ), 
            
            React.createElement("li", null, 
              React.createElement("a", {className: "add-app"}, 
                React.createElement("i", {className: "fa fa-plus bg-blue-grey"}), 
                React.createElement("span", null, "Ajouter une App")
              )
            )

          )
        )
      )

    ));
  }
});
//# sourceMappingURL=../applications/miit-team-home-page.js.map