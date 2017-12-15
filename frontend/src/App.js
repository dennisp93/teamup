import React, { Component } from 'react';
import { Switch, Route } from 'react-router-dom';
import './App.css';
import Menubar from "./Menubar/Menubar";
import DateViewer from "./DateViewer/DateViewer";

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      selectedTeam: 'TV Rheinbach Herren',
      user: {
        name: 'Dennis Tester',
        mail: 'dennis@email.de'
      }
    }
  }

  render() {
    return (
      <div>
        <header>
          <Menubar user={this.state.user} selectedTeam={this.state.selectedTeam}/>
        </header>
        <main>
          <Switch>
            <Route exact path='/dates' component={DateViewer} />
            <Route exact path='/team' component={DateViewer} />
          </Switch>
        </main>
      </div>
    );
  }
}

export default App;
