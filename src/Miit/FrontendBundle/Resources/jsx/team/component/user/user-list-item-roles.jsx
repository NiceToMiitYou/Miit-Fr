MiitComponents.UserListItemRoles = React.createClass({
    getDefaultProps: function() {
        return {
            text: {
                admin:  MiitTranslator.get('user-list.actions.admin', 'team'),
                user:   MiitTranslator.get('user-list.actions.user', 'team'),
                remove: MiitTranslator.get('user-list.actions.remove', 'team')
            },
            user: {
                id:    '',
                roles: []
            }
        };
    },

    getInitialState: function() {
        return {
            loading: false
        };
    },

    onAction: function(data) {
        this.setState({
            loading: false
        });

        if(typeof this.props.onAction === 'function') {
            this.props.onAction();
        }
    },

    toggleRole: function(role, cb) {
        var action = 'promote';

        if(this.props.user.roles.indexOf(role) >= 0) {
            action = 'demote';
        }

        MiitApp.request.user[action](this.props.user.id, [role], this.onAction);
    },

    handleClick: function(action, e) {
        e.preventDefault();

        // Don't load twice
        if(this.state.loading)
            return;

        var IAmAdmin    = MiitApp.utils.user.isAdmin();
        var userIsOwner = MiitApp.utils.user.isOwner(this.props.user);
        var userIsAdmin = MiitApp.utils.user.isAdmin(this.props.user);
        var userIsMe    = MiitApp.utils.user.isItMe(this.props.user);

        // Check if I am an admin and not myself or an owner
        if(!IAmAdmin || userIsMe || userIsOwner)
            return;

        // Check if I want to remove an admin
        if(action === 'REMOVE' && userIsAdmin)
            return;

        this.setState({
            loading: true
        });

        switch(action) {
            case 'ADMIN':
            case 'USER':
                this.toggleRole(action);
                break;

            case 'REMOVE':
                MiitApp.request.user.remove(this.props.user.id, this.onAction);
                break;
        }
    },

    render: function() {
        var cx = React.addons.classSet;

        var IAmAdmin    = MiitApp.utils.user.isAdmin();
        var userIsAdmin = MiitApp.utils.user.isAdmin(this.props.user);
        var userIsUser  = MiitApp.utils.user.isUser(this.props.user);
        var userIsMe    = MiitApp.utils.user.isItMe(this.props.user);

        var user_active = cx({
            disable: !IAmAdmin || userIsMe || userIsAdmin,
            active:  userIsUser
        });

        var admin_active = cx({
            disable: !IAmAdmin || userIsMe,
            active:  userIsAdmin
        });

        var remove_active = cx({
            disable: !IAmAdmin || userIsMe || userIsAdmin
        });

        return (
            <span className="miit-component user-list-item-roles">
                <span onClick={this.handleClick.bind(this, 'USER')}   className={user_active} >
                    {this.props.text.user}
                </span>
                <span onClick={this.handleClick.bind(this, 'ADMIN')}  className={admin_active}>
                    {this.props.text.admin}
                </span>
                <span onClick={this.handleClick.bind(this, 'REMOVE')} className={remove_active}>
                    {this.props.text.remove}
                </span>
            </span>
        );
    }
});