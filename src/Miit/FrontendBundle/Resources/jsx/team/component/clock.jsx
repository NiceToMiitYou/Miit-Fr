(function(){

    var ClockFace = React.createClass({
      render: function() {

        var d = this.props.date;
        var second = d.getSeconds();
        var minute = (d.getMinutes()<10?'0':'') + d.getMinutes();
        var hour = d.getHours();

        return (
          <div className="miit-component clock">
                <i className="fa fa-clock-o pull-left"></i>
              <span>{hour}:</span>
              <span>{minute}</span>
          </div>
        );
      }
    });


    MiitComponents.Clock = React.createClass({
      getInitialState: function() {
        return { date: new Date() };
      },
      componentDidMount: function() {
        this.start();
      },
      start: function() {
        var self = this;
        (function tick() {
          self.setState({ date: new Date() });
        }());
      },
      render: function() {
        return <ClockFace date={this.state.date} />;
      }
    });
 
})();