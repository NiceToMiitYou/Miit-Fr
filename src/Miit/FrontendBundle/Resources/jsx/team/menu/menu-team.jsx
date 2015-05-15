(function(){
    MiitComponents.MenuTeam = React.createClass({
        render: function() {
            return (
                <div className="sidr-left bg-blue-grey">
                    <div className="sl-wrapper">
                        <MiitComponents.MenuHeader />
                        
                        <MiitComponents.MenuLabel label="Utilisateur" />
                        <MiitComponents.MenuUserProfile />
                        <ul className="sl-list mb10">
                            <li>
                                <Link href="#/me" activeGroup="menu-team" activeName="me">
                                    <i className="fa fa-cogs pull-left"></i> Mon compte
                                </Link>
                            </li>
                            <li>
                                <Link href="/logout">
                                    <i className="fa fa-sign-out pull-left"></i> Deconnexion
                                </Link>
                            </li>
                        </ul>


                        <MiitComponents.MenuLabel label="Apps" />
                        <ul className="sl-list">
                            <li>
                                <Link href="#/home" activeGroup="menu-team" activeName="home">
                                    <i className="fa fa-weixin pull-left"></i> Chat
                                    <span className="notification">4</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="#/quizz" activeGroup="menu-team" activeName="quizz">
                                    <i className="fa fa-question pull-left"></i> Quizz
                                </Link>
                            </li>
                            <li>
                                <Link href="#/test2/plop">
                                    <i className="fa fa-folder-o pull-left"></i> Documents
                                    <span className="notification">18</span>
                                </Link>
                            </li>
                            <li>
                                <Link href="/test2/plop">
                                    <i className="fa fa-plus pull-left"></i> Ajouter une App
                                </Link>
                            </li>
                        </ul>

                    </div>
                </div>
            );
        }
    });
})();