(function(){
    MiitComponents.MiitPage = React.createClass({
        render: function() {
            return (
                <div>
                    <MiitComponents.MiitHeader />
                    <MiitComponents.MiitContent />
                </div>
            );
        }
    });

    MiitApp
        .get('miit-page-store')
        .registerMainPage('home', (<MiitComponents.MiitPage />));
})();