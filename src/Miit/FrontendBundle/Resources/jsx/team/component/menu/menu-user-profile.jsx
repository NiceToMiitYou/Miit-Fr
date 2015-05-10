(function(){
    var UserStore;

    MiitComponents.MenuUserProfile = React.createClass({
       getDefaultProps: function() {
            return {
                text: {
                    logout:    'Déconnexion',
                    profile:   'Modifier mon profile',
                    team:   'Modifier la team'
                }
            };
        },

        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        render: function() {
            var user = UserStore.getUser();

            return (
                <span className="sl-footer miit-component user-profile">
                    <div className="avatar">
                        <MiitComponents.UserAvatar user={user} />
                    </div>
                    <Dropdown label={ user.name } angle="up">
                        <ul className="sl-list">
                            <li>
                                <Link href="/me">
                                    <i className="fa fa-user"></i>
                                    {this.props.text.profile}
                                </Link> 
                            </li>
                            <If test={UserStore.isAdmin() }>
                                <li>
                                    <Link href="/us">
                                        <i className="fa fa-users"></i>
                                        {this.props.text.team}
                                    </Link> 
                                </li>
                            </If>
                            <li>
                                <Link href="/logout" external={true}>
                                    <i className="fa fa-sign-out"></i>
                                    {this.props.text.logout}
                                </Link> 
                            </li> 
                        </ul>
                    </Dropdown>
                </span>
            );
        }
    });
})();