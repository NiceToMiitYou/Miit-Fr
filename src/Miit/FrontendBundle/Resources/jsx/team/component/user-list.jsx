MiitComponents.UserList = React.createClass({
    getDefaultProps: function() {
        return {
            users: []
        };
    },

    render: function() {
        return (
            <div className="miit-component user-list">
                <MiitComponents.UserListHeader />
                {this.props.users.map(function(user) {
                    return <MiitComponents.UserListItem user={user} />;
                })}
            </div>
        );
    }
});