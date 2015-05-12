(function(){
    MiitComponents.MenuTeam = React.createClass({
        render: function() {
            return (
                <div className="sidr-left bg-blue-grey">
                    <div className="sl-wrapper">

                        <MiitComponents.MenuHeader />

                        <ul className="sl-list">
                            <li>
                                <Link href="#/home" activeGroup="menu-team" activeName="home">
                                    <i className="fa fa-weixin bg-blue"></i> Chat
                                </Link>
                            </li>
                            <li>
                                <Link href="#/me" activeGroup="menu-team" activeName="me">
                                    <i className="fa fa-question bg-green"></i> Quizz
                                </Link>
                            </li>
                            <li>
                                <Link href="#/test2/plop">
                                    <i className="fa fa-folder-o bg-red"></i> Documents
                                </Link>
                            </li>
                            <li>
                                <Link href="/test2/plop">
                                    <i className="fa fa-plus bg-blue-grey"></i> Ajouter
                                </Link>
                            </li>
                        </ul>

                        <MiitComponents.MenuUserProfile />
                    </div>
                </div>
            );
        }
    });
})();