MiitComponents.MiitTeamHeader = React.createClass({displayName: "MiitTeamHeader",
  render: function() {
    return (
        React.createElement("div", {className: "page-header z-depth-1"}, 
            React.createElement("h1", null, React.createElement("i", {className: "fa fa-circle-thin pull-left stat-open"}), " Miit ouvert ", React.createElement("a", {className: "ph-title"}, React.createElement("i", {className: "fa fa-cog pull-right"}))), 

            React.createElement("ul", {className: "ph-btn-list"}, 
                React.createElement("li", {className: "active"}, React.createElement("a", null, React.createElement("i", {className: "fa fa-question pull-left"}), "Quizz ", React.createElement("span", null, "Que pensez-vous de..."), " ", React.createElement("i", {className: "fa fa-times pull-right"}))), 
                React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-weixin"}), "Chat", React.createElement("i", {className: "fa fa-times pull-right"}))), 
                React.createElement("li", null, React.createElement("a", null, React.createElement("i", {className: "fa fa-plus pull-left"}), " Ajouter"))
            )
        )
    );
  }
});

//# sourceMappingURL=../components/miit-team-header.js.map