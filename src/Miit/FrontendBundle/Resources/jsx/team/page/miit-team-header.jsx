(function(){
    MiitComponents.MiitTeamHeader = React.createClass({
        render: function() {
            return (
                <div className="page-header z-depth-1">
                    <h1><i className="fa fa-circle-thin pull-left stat-open"></i> Miit ouvert <a className="ph-title"><i className="fa fa-cog pull-right"></i></a></h1>

                    <ul className="ph-btn-list">
                        <li className="active"><a><i className="fa fa-question pull-left"></i>Quizz <span>Que pensez-vous de...</span> <i className="fa fa-times pull-right"></i></a></li>
                        <li><a><i className="fa fa-weixin"></i>Chat<i className="fa fa-times pull-right"></i></a></li>
                        <li><a><i className="fa fa-plus pull-left"></i> Ajouter</a></li>
                    </ul>
                </div>
            );
        }
    });
})();