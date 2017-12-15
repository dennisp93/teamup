import React, { Component } from 'react';

class ListView extends Component {
  constructor(props) {
    super(props);

    this.state = {
      dates: this.props.dates
    }
  }

  changeState(key, state) {
    let tempDates = this.state.dates;
    tempDates[key].state = state;

    this.setState({
      dates: tempDates
    });
  }

  render() {
    return (
      <div>
        <h2>Kommende Termine</h2>
        {this.state.dates.map((date, key) => this.renderDate(date, key))}
      </div>
    );
  }

  renderDate(date, key) {
    return (
      <ul key={key}>
        <li>{date.type}</li>
        <li>{date.day}</li>
        <li>{date.time}</li>
        <li>{date.state}</li>
        <li><button onClick={() => this.changeState(key, 'available')}>Zusagen</button></li>
        <li><button onClick={() => this.changeState(key, 'open')}>Offen</button></li>
        <li><button onClick={() => this.changeState(key, 'unavailable')}>Absagen</button></li>
      </ul>
    );
  }
}

export default ListView;
