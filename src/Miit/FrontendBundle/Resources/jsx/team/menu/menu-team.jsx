MiitComponents.MenuTeam = React.createClass({
    render: function() {
        return (
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
                        <div className="avatar border-circle">
                            <MiitComponents.UserAvatar />
                        </div>
                        <span>John Random
                            <i className="fa fa-angle-up pull-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        );
    }
});