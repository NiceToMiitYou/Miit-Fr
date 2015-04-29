MiitComponents.UserListItem = React.createClass({
    getDefaultProps: function() {
        return {
            user: {
                name:  'unknow',
                roles: []
            }
        };
    },

    render: function() {
        return (
            <div className="miit-component user-list-item">
                <span>{this.props.user.name}</span>
            </div>
        );
    }
});