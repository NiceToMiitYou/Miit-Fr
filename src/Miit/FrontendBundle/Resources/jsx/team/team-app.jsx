(function(){
    var Router, TeamStore, TeamActions, PageStore, PageActions;

    var defaultPage = 'home';

    MiitComponents.TeamApp = React.createClass({
        getInitialState: function() {
            return {
                page: null
            };
        },

        componentWillMount: function() {
            // Get the page store
            if(!PageStore) {
                PageStore = MiitApp.get('miit-page-store');
            }
            // Get the page actions
            if(!PageActions) {
                PageActions = MiitApp.get('miit-page-actions');
            }
            // Get the page store
            if(!TeamStore) {
                TeamStore = MiitApp.get('miit-team-store');
            }
            // Get the page actions
            if(!TeamActions) {
                TeamActions = MiitApp.get('miit-team-actions');
                TeamActions.refresh();
            }
            // Get the router and handle page change
            if(!Router) {
                Router = MiitApp.get('miit-router');
                Router.routes.set('/([a-zA-Z0-9_\-]{0,})', function(mainPage) {
                    var page = mainPage || defaultPage;

                    // Set the current active page of the menu
                    ActiveGroups['menu-team'] = page;

                    // Set the current active page          
                    PageActions.changeMainPage(page);
                });
            }
        },

        componentDidMount: function() {
            PageStore.addMainPageChangedListener(this._onChange);
        },

        componentWillUnmount: function() {
            PageStore.removeMainPageChangedListener(this._onChange);
        },

        _onChange: function() {
            var page = PageStore.getCurrentMainPage();

            if(!page)
            {
                setTimeout(function(){
                    PageActions.changeMainPage('not-found');
                }, 0);
            }
            else if(this.isMounted())
            {
                this.setState({
                    page: page
                });
            }
        },

        render: function() {
            return (
                <div className="page bg-grey lighten-5">
                    <MiitComponents.MenuTeam />

                    <div className="main">
                        {this.state.page}
                    </div>
                </div>
            );
        }
    });
})();