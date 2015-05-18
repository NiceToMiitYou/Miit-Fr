(function(){
    MiitComponents.Loading = React.createClass({

        getDefaultProps: function() {
            return {
                loading: MiitTranslator.get('loading', 'team')
            };
        },

        render: function() {
          return (
              <div className="miit-component loading-container">
                  <div className="loading">
                      <img src="/img/logo-miit-outter.png"/>
                      <img className="inner" src="/img/logo-miit-inner.png"/>
                  </div>
                  {this.props.loading}
              </div>
          );
        }
    });
})();