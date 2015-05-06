(function(){
    var Utils;

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
            if(!Utils) {
                Utils = MiitApp.get('miit-utils');
            }
        },

        render: function() {
            var actionElement = null;

            // Check if this is an admin
            if(Utils.user.isAdmin()){
                actionElement = (<span>{this.props.text.action}</span>);
            }

            return (
                <div className="miit-component user-list-header">
                    <span>{this.props.text.avatar}</span>
                    <span>{this.props.text.name}</span>
                    <span>{this.props.text.email}</span>
                    {actionElement}
                </div>
            );
        }
    });
})();