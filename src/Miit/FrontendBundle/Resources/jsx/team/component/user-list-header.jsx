MiitComponents.UserListHeader = React.createClass({
    getDefaultProps: function() {
        return {
            title: {
                name:   'Name',
                action: 'Action'
            }
        };
    },

    render: function() {
        var actionElement = null;

        // Check if this is an admin
        if(MiitApp.utils.user.isAdmin()){
            actionElement = (<span>{this.props.title.action}</span>);
        }

        return (
            <div className="miit-component user-list-header">
                <span>{this.props.title.name}</span>
                {actionElement}
            </div>
        );
    }
});