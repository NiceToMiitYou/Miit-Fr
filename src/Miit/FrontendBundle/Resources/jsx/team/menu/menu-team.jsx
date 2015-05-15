(function(){
    var UserStore;

    MiitComponents.MenuTeam = React.createClass({
        getDefaultProps: function () {
            return {
                text: {
                    user_label: 'Utilisateur',
                    my_account: 'Mon compte',
                    disconnect: 'Déconnexion',
                    connect: 'Connexion',
                    apps_label: 'Applications'
                }
            };
        },

        componentWillMount: function() {
            // Get the user store
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        render: function() {
            return (
                <div className="sidr-left bg-blue-grey">
                    <div className="sl-wrapper">
                        <MiitComponents.MenuHeader />
                        
                        <MiitComponents.MenuLabel label={this.props.text.user_label} />
                        <MiitComponents.MenuUserProfile />

                        <ul className="sl-list mb10">
                            <If test={UserStore.isUser()}>
                                <li>
                                    <Link href="#/me" activeGroup="menu-team" activeName="me">
                                        <i className="fa fa-cogs pull-left"></i> {this.props.text.my_account}
                                    </Link>
                                </li>
                            </If>
                            <If test={UserStore.isUser()}>
                                <li>
                                    <Link href="/logout">
                                        <i className="fa fa-sign-out pull-left"></i> {this.props.text.disconnect}
                                    </Link>
                                </li>
                            </If>
                            <If test={UserStore.isAnonym()}>
                                <li>
                                    <Link href="/login">
                                        <i className="fa fa-sign-in pull-left"></i> {this.props.text.connect}
                                    </Link>
                                </li>
                            </If>
                        </ul>

                        <MiitComponents.MenuLabel label={this.props.text.apps_label} />
                        
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