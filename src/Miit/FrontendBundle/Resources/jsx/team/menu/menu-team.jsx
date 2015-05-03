MiitComponents.MenuTeam = React.createClass({
    render: function() {
        return (
            <div className="sidr-left bg-blue-grey">
                <div className="sl-wrapper">
                    <MiitComponents.MenuHeader />

                    <MiitComponents.MenuLabel icon="fa-heart" label="Favorites" />

                    <ul className="sl-list">
                        <li><a><i className="fa fa-weixin pull-left"></i>Chat miit</a></li>
                        <li><a><i className="fa fa-question pull-left"></i>Quizz : Que pensez-vous...</a></li>
                    </ul>

                    <MiitComponents.MenuLabel icon="fa-map-marker" label="Miits" />

                    <ul className="sl-list">
                        <li><a className="active"><i className="fa fa-circle-thin pull-left stat-open"></i> Miit ouvert</a></li>
                        <li><a><i className="fa fa-circle-thin pull-left stat-ready"></i> Miit prêt</a></li>
                        <li><a><i className="fa fa-circle-thin pull-left stat-config"></i> Miit en configuration</a></li>
                        <li><a><i className="fa fa-plus pull-left"></i> Créer un Miit</a></li>
                    </ul>

                    <MiitComponents.MenuUserProfile />
                </div>
            </div>
        );
    }
});