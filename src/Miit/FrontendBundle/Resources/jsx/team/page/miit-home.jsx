(function(){
    MiitComponents.MiitHome = React.createClass({
        getDefaultProps: function () {
            return {
                title: 'Welcome'
            };
        },

        render: function() {
            return (
                    <div className="container-fluid">
                        <h1 className="pt25">{this.props.title}</h1>
                    </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('home', (<MiitComponents.MiitHome />));
})();