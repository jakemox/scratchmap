import React from 'react';
import {render} from 'react-dom';

export default class Profile extends React.Component {
  constructor(props) {
    super(props)
  
    this.state = {
      visible: true,
      users: []
    }
  }

  componentDidMount() {
    Axios.get('profile/api')
    .then(response => {
      console.log(response.data.users);
      this.setState({
      users : response.data.users
      
      })
    })
  }

  render() {
    return (
    <div class="details">
        Hi we love you
        </div>
    );
  }

  
}