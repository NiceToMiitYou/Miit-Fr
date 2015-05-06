(function() {
    var Utils, UserRequest;

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

        componentWillMount: function() {
            if(!Utils) {
                Utils = MiitApp.get('miit-utils');
            }
            if(!UserRequest) {
                UserRequest = MiitApp.get('miit-user-request');
            }
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

            UserRequest[action](this.props.user.id, [role], this.onAction);
        },

        handleClick: function(action, e) {
            e.preventDefault();

            // Don't load twice
            if(this.state.loading)
                return;

            var IAmAdmin    = Utils.user.isAdmin();
            var userIsOwner = Utils.user.isOwner(this.props.user);
            var userIsAdmin = Utils.user.isAdmin(this.props.user);
            var userIsMe    = Utils.user.isItMe(this.props.user);

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
                    UserRequest.remove(this.props.user.id, this.onAction);
                    break;
            }
        },

        render: function() {
            var IAmAdmin    = Utils.user.isAdmin();
            var userIsAdmin = Utils.user.isAdmin(this.props.user);
            var userIsUser  = Utils.user.isUser(this.props.user);
            var userIsMe    = Utils.user.isItMe(this.props.user);

            var user_active = classNames({
                disable: !IAmAdmin || userIsMe || userIsAdmin,
                active:  userIsUser
            });

            var admin_active = classNames({
                disable: !IAmAdmin || userIsMe,
                active:  userIsAdmin
            });

            var remove_active = classNames({
                disable: !IAmAdmin || userIsMe || userIsAdmin
            });

            return (
                <span className="miit-component user-list-item-roles">
                    <div className="checkbox-field pull-left" onClick={this.handleClick.bind(this, 'USER')} >
                        <label>
                            <input type="checkbox" className="option-input checkbox" checked={userIsUser} readOnly/>
                            {this.props.text.user}
                        </label>
                    </div>

                    <div className="checkbox-field pull-left ml20" onClick={this.handleClick.bind(this, 'ADMIN')} >
                        <label>
                            <input type="checkbox" className="option-input checkbox" checked={userIsAdmin} readOnly/>
                            {this.props.text.admin}
                        </label>
                    </div>

                    <button onClick={this.handleClick.bind(this, 'REMOVE')} className='btn btn-danger ml20' disabled={remove_active}>
                        <i className="fa fa-trash-o"></i>
                    </button>
                </span>
            );
        }
    });
})();