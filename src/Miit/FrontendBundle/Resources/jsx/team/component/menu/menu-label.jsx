(function(){
    MiitComponents.MenuLabel = React.createClass({
        render: function() {
            var cx = React.addons.classSet;
            
            var classes = cx('pull-left', 'fa', this.props.icon || '');
            
            return (
                <span className="miit-component menu-label sl-label">
                    <i className={classes}></i>
                    {this.props.label}
                </span>
            );
        }
    });
})();