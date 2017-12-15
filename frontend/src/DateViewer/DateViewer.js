import React, { Component } from 'react';

class DateViewer extends Component {
  render() {
    console.log(this.props.route.config);
    return (
      <div>
        <h2>DateViewer</h2>
      </div>
    );
  }
}

export default DateViewer;
