(function(){
    var UserStore;

    MiitComponents.MenuUserProfile = React.createClass({
       getDefaultProps: function() {
            return {
                text: {
                    logout:  'Déconnexion',
                    login:   'Connexion',
                    profile: 'Modifier mon profile',
                    team:    'Modifier l\'équipe'
                }
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        componentDidMount: function() {
            UserStore.addUserUpdatedListener(this._onChanged);
        },

        componentWillUnmount: function() {
            UserStore.removeUserUpdatedListener(this._onChanged);
        },

        _onChanged: function() {
            this.forceUpdate();
        },

        render: function() {
            var user = UserStore.getUser();
            var name = UserStore.getName(user);

            return (
                <span className="sl-footer miit-component user-profile">
                    <div className="avatar">
                        <MiitComponents.UserAvatar user={user} />
                    </div>
                    <Dropdown label={ name } angle="up">
                        <ul className="sl-list">
                            <If test={UserStore.isAdmin()}>
                                <li>
                                    <Link href="/settings">
                                        <i className="fa fa-users"></i>
                                        {this.props.text.team}
                                    </Link> 
                                </li>
                            </If>
                            <If test={UserStore.isUser()}>
                                <li>
                                    <Link href="/me">
                                        <i className="fa fa-user"></i>
                                        {this.props.text.profile}
                                    </Link> 
                                </li>
                            </If>
                            <If test={UserStore.isUser()}>
                                <li>
                                    <Link href="/logout" external={true}>
                                        <i className="fa fa-sign-out"></i>
                                        {this.props.text.logout}
                                    </Link> 
                                </li>
                            </If>
                            <If test={UserStore.isAnonym()}>
                                <li>
                                    <Link href="/login" external={true}>
                                        <i className="fa fa-sign-in"></i>
                                        {this.props.text.login}
                                    </Link> 
                                </li>
                            </If>
                        </ul>
                    </Dropdown>
                </span>
            );
        }
    });
})();