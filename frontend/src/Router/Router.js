import React, { Component } from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import App from "../App";

class Router extends Component {
  render() {
    return(
    <BrowserRouter>
      <Switch>
        <Route path='/' component={App} />
      </Switch>
    </BrowserRouter>
    )
  }
}

export default Router