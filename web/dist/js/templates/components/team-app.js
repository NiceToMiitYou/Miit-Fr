MiitComponents.TeamApp = React.createClass({displayName: "TeamApp",
    render: function() {
        return (
            React.createElement("div", {className: "page bg-grey lighten-5"}, 
                React.createElement(MiitComponents.MenuTeam, null), 

                React.createElement("div", {className: "main"}, 
                    React.createElement(MiitComponents.MiitTeamHeader, null), 
                    React.createElement(MiitComponents.MiitTeamContent, null)
                )
            )
        );
    }
});
//# sourceMappingURL=../components/team-app.js.map