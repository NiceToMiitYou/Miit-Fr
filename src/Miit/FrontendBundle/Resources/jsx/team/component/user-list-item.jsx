MiitComponents.UserListItem = React.createClass({
    getDefaultProps: function() {
        return {
            user: {
                name:  'unknow',
                roles: []
            }
        };
    },

    shouldComponentUpdate: function(nextProps, nextState) {
        return nextProps.user.id !== this.props.user.id;
    },

    render: function() {
        return (
            <div className="miit-component user-list-item">
                <span>{this.props.user.name}</span>
            </div>
        );
    }
});