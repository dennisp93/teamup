import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import './Menubar.css';

class Menubar extends Component {
  render() {
    return (
      <menu>
        { this.renderMenu() }
        { this.renderUserInfo() }
      </menu>
    )
  }

  renderMenu() {
    return (
      <nav>
        <ul>
          <li><Link to={'/teamchoice'}>{this.props.selectedTeam}</Link></li>
          <li><Link to={'/dates'}>Termine</Link></li>
          <li><Link to={'/team'}>Mitglieder</Link></li>
          <li><Link to={'/'}>E-Mail</Link></li>
          <li><Link to={'/'}>Mein Profil</Link></li>
        </ul>
      </nav>
    )
  }

  renderUserInfo() {
    return (
      <div className="userInfo">
        <ul>
          <li><Link to={'/profile'}>{this.props.user.name}</Link></li>
          <li><Link to={'/logout'}>Logout</Link></li>
        </ul>
      </div>
    )
  }
}

export default Menubar;