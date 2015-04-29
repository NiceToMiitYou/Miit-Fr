MiitComponents.UserListHeader = React.createClass({
    getDefaultProps: function() {
        return {
            title: {
                name: 'Name'
            }
        };
    },

    render: function() {
        return (
            <div className="miit-component user-list-header">
                <span>{this.props.title.name}</span>
            </div>
        );
    }
});