(function(){
    var UserStore;

    MiitComponents.UserListHeader = React.createClass({
        getDefaultProps: function() {
            return {
                text: {
                    avatar: 'Avatar',
                    name:   'Name',
                    email:  'Email',
                    action: 'Action'
                }
            };
        },
        
        componentWillMount: function() {
            if(!UserStore) {
                UserStore = MiitApp.get('miit-user-store');
            }
        },

        render: function() {
            return (
                <div className="miit-component user-list-header">
                    <span>{this.props.text.avatar}</span>
                    <span>{this.props.text.name}</span>
                    <If test={UserStore.isUser()}>
                        <span>{this.props.text.email}</span>
                    </If>
                    <If test={UserStore.isAdmin()}>
                        <span>{this.props.text.action}</span>
                    </If>
                </div>
            );
        }
    });
})();