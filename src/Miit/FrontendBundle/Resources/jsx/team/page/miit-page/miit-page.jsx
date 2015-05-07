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

    var PageStore = MiitApp.get('miit-page-store');
    PageStore.registerPage('home', (<MiitComponents.MiitPage />));
})();