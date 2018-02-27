import React, { Component } from 'react';
import './ListView.css';

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
      <div className="container">
        <h2>Kommende Termine</h2>
        {this.state.dates.map((date, key) => this.renderDate(date, key))}
      </div>
    );
  }

  renderDate(date, key) {
    return (
      <ul key={key} className="date">
        <li className="type">{date.type}</li>
        <li className="day">{date.day}</li>
        <li className="time">{date.time} Uhr</li>
        <li className={"state " + date.state}>{date.state}</li>
        <li><button onClick={() => this.changeState(key, 'available')} className="available">Zusagen</button></li>
        <li><button onClick={() => this.changeState(key, 'open')} className="open">Offen</button></li>
        <li><button onClick={() => this.changeState(key, 'unavailable')} className="unavailable">Absagen</button></li>
      </ul>
    );
  }
}

export default ListView;
