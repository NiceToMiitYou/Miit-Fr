var Link = React.createClass({
    onClick: function(e) {
        if(!this.props.external) {
            // If there is an hystory
            e.preventDefault();

            // Extract the target
            var target = this.props.href || '';
            target     = target.substr(target.indexOf('#') + 1);
            
            // Set the route in the router
            injector.get('miit-router').setRoute(target);
        }
    },

    render: function() {
        return (
            <a {...this.props} onClick={this.onClick}>
                {this.props.children}
            </a>
        );
    }
});