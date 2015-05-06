var Dropdown = React.createClass({
    propTypes: {
        label: React.PropTypes.string.isRequired
    },

    getDefaultProps: function() {
        return {
            angle: 'down'
        };
    },

    getInitialState: function () {
        return {
            open: false
        };
    },

    onLeave: function() {
        this.setState({
            open: false
        });
    },

    onEnter: function() {
        this.setState({
            open: !this.state.open
        });
    },

    render: function() {
        var classes = classNames('fa', 'fa-angle-' + this.props.angle, 'pull-right');

        return (
            <span onMouseLeave={this.onLeave} onClick={this.onEnter} className="miit-component dropdown">
                <span className="dropdown-label">
                    {this.props.label}
                    <i className={classes}></i>
                </span>
                
                <If test={this.state.open}>
                    <div className="dropdown-inner">
                        {this.props.children}
                    </div>
                </If>
            </span>
        );
    }
});