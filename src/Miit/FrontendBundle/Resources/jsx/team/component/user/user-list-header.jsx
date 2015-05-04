MiitComponents.UserListHeader = React.createClass({
    getDefaultProps: function() {
        return {
            text: {
                avatar:   'Avatar',
                name:   'Name',
                action: 'Action'
            }
        };
    },

    render: function() {
        var actionElement = null;

        // Check if this is an admin
        if(MiitApp.utils.user.isAdmin()){
            actionElement = (<span>{this.props.text.action}</span>);
        }

        return (
            <div className="miit-component user-list-header">
                <span>{this.props.text.avatar}</span>
                <span>{this.props.text.name}</span>
                {actionElement}
            </div>
        );
    }
});