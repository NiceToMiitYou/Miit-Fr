MiitComponents.Link = React.createClass({
    onClick: function(e) {
        // If there is an hystory
        e.preventDefault();

        // Extract the target
        var target = this.props.href || '';
        target     = target.substr(target.indexOf('#') + 1);
        
        // Set the route in the router
        MiitApp.router.setRoute(target);
    },

    render: function() {
        return (
            <a{...this.props} onClick={this.onClick}>{this.props.children}</a>
        );
    }
});