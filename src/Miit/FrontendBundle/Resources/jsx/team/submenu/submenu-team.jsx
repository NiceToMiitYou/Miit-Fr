(function(){
    MiitComponents.SubMenuTeam = React.createClass({
        render: function() {
            return (

                    <div className="sidr-sub">
                        <MiitComponents.SubMenuHeader />

                        <ul className="sb-list">
                            
                            <li>
                                <Link href="#/home" activeGroup="submenu-team" activeName="chan1">
                                    <i className="fa fa-users"></i> Channel 1
                                    <span className="peoples">7 personnes</span>
                                    <div className="actions">
                                        <i className="fa fa-times pull-right"></i>
                                        <i className="fa fa-pencil pull-right"></i>
                                    </div>
                                </Link>
                            </li>
                            <li>
                                <Link href="#/home" activeGroup="submenu-team" activeName="chan2">
                                    <i className="fa fa-users"></i> Channel 2
                                    <span className="peoples">7 personnes</span>
                                    <div className="actions">
                                        <i className="fa fa-times pull-right"></i>
                                        <i className="fa fa-pencil pull-right"></i>
                                    </div>
                                </Link>
                            </li>
                            <li>
                                <Link href="#/home" activeGroup="submenu-team" activeName="chan3">
                                    <i className="fa fa-users"></i> Channel 3
                                    <span className="peoples">7 personnes</span>
                                    <div className="actions">
                                        <i className="fa fa-times pull-right"></i>
                                        <i className="fa fa-pencil pull-right"></i>
                                    </div>
                                </Link>
                            </li>
                            <li>
                                <Link href="#/home" activeGroup="submenu-team" activeName="chan3">
                                    <i className="fa fa-plus"></i> Créer un channel
                                </Link>
                            </li>

                        </ul>
                    </div>
            );
        }
    });
})();