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
        var clIcon = classNames('fa', 'fa-angle-' + this.props.angle, 'pull-right');
        var clDropdown = classNames('miit-component', 'dropdown', {open:this.state.open, close:this.state.open});
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