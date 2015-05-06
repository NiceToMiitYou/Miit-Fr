(function(){
    var Storage;

    MiitComponents.MenuUserProfile = React.createClass({
       getDefaultProps: function() {
            return {
                text: {
                    logout:    'Déconnexion'
                }
            };
        },

        componentWillMount: function() {
            if(!Storage) {
                Storage = MiitApp.get('miit-storage');
            }
        },

        render: function() {
            var user = Storage.shared.get('user');

            return (
                <span className="sl-footer miit-component user-profile">
                    <div className="avatar">
                        <MiitComponents.UserAvatar user={user} />
                    </div>
                    <Dropdown label={ user.name } angle="up">
                        <ul className="sl-list">
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