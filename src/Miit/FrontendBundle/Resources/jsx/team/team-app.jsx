MiitComponents.TeamApp = React.createClass({
    render: function() {
        return (
            <div className="page bg-grey lighten-5">
                <MiitComponents.MenuTeam />
                <MiitComponents.ChangePassword />

                <div className="main">
                    <MiitComponents.MiitTeamHeader />
                    <MiitComponents.MiitTeamContent />
                </div>
            </div>
        );
    }
});