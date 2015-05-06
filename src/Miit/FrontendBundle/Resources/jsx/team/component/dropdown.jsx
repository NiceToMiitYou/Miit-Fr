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
        var icon = 'fa-angle-' + this.props.angle;
        var open = { open: this.state.open };

        var clIcon     = classNames('pull-right', 'fa', icon);
        var clDropdown = classNames('miit-component', 'dropdown', open);

        return (
            <span onMouseLeave={this.onLeave} onClick={this.onEnter} className={clDropdown}>
                <span className="dropdown-label">
                    {this.props.label}
                    <i className={clIcon}></i>
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