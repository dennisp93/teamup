import React, { Component } from 'react';

class DefaultView extends Component {
  render() {
    console.log(this.props);
    return (
      <div>
        <h2>Kommende Termine</h2>
        <p>{this.props.route.config.dateViewer}</p>
      </div>
    );
  }
}

export default DefaultView;
