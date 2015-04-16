MiitComponents.MenuTeam = React.createClass({displayName: "MenuTeam",
    render: function() {
        return (
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
            )
        );
    }
});
//# sourceMappingURL=../components/menu-team.js.map