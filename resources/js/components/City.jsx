import React from 'react'
import {render} from 'react-dom'
import Axios from 'axios';
import Attraction from './Attraction.jsx'
import Profile from './Profile.jsx'
console.log("city.js loaded")

export default class City extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visible: true,
      attractions: [],
      isLoading: true
    }

  }

  
  componentDidMount() {
    Axios.get('/city/api/' + this.props.cityName)
    .then(response => {
      this.setState({
        attractions: response.data.attractions,
        isLoading: false
      })
    })
  }

  render() {
    return (
      <div className="city-info">
        <h2>Top attractions in {this.props.cityName}</h2><br />
        {this.state.attractions.map(element => 
            <Attraction
            name={element.name}
            pic={element.photo}
            />
        )
        }
        <Profile />
      </div>
      )

  }
}
