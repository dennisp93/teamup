import React, { Component } from 'react';
import ListView from "./ListView";
import TableView from "./TableView";

class DateViewer extends Component {
  constructor(props) {
    super(props);

    this.state = {
      config: {
        dateViewer: 'list'
      },
      dates: [
        {
          type: 'training',
          day: '12.12.2025',
          time: '20:00',
          state: 'open'
        },
        {
          type: 'training',
          day: '12.12.2025',
          time: '20:00',
          state: 'open'
        },
        {
          type: 'game',
          day: '12.12.2025',
          time: '20:00',
          state: 'open'
        }
      ]
    }
  }

  toggleView(view) {
    this.setState({
      config: {
        dateViewer: view
      }
    })
  }

  render() {
    return (
      <div>
        <button onClick={() => this.toggleView('table')}>Tabelle</button>
        <button onClick={() => this.toggleView('list')}>Liste</button>
        { this.renderView() }
      </div>
    );
  }

  renderView() {
    if (this.state.config.dateViewer === 'list') return this.renderListView();
    if (this.state.config.dateViewer === 'table') return this.renderTableView();
  }

  renderListView() {
    return (
      <ListView dates={this.state.dates}/>
    );
  }

  renderTableView() {
    return (
      <TableView/>
    )
  }
}

export default DateViewer;
