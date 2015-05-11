(function(){
    MiitComponents.MenuTeam = React.createClass({
        render: function() {
            return (
                <div className="sidr-left bg-blue-grey">
                    <div className="sl-wrapper">
                        <MiitComponents.MenuHeader />

                        <MiitComponents.MenuLabel icon="fa-map-marker" label="Applications" />

                        <ul className="sl-list">
                            <li>
                                <Link href="#/home" activeGroup="menu-team" activeName="home">
                                    <i className="fa fa-circle-thin pull-left stat-open"></i> Miit ouvert
                                </Link>
                            </li>
                            <li>
                                <Link href="#/me" activeGroup="menu-team" activeName="me">
                                    <i className="fa fa-circle-thin pull-left stat-ready"></i> Miit prêt
                                </Link>
                            </li>
                            <li><Link href="#/test2/plop"><i className="fa fa-circle-thin pull-left stat-config"></i> Miit en configuration</Link></li>
                            <li><Link href="/test2/plop"><i className="fa fa-plus pull-left"></i> Créer un Miit</Link></li>
                        </ul>

                        <MiitComponents.MenuUserProfile />
                    </div>
                </div>
            );
        }
    });
})();