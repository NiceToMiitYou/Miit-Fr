(function(){
    MiitComponents.MiitHome = React.createClass({
        getDefaultProps: function () {
            return {
                title: 'Welcome'
            };
        },

        render: function() {
            return (
                <div className="page-content miit-home">
                    <div className="container-fluid">
                        <h1 className="pt25">{this.props.title}</h1>

                    </div>
                </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('home', (<MiitComponents.MiitHome />));
})();