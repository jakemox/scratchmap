import React from 'react'
import {render} from 'react-dom'
import Axios from 'axios';
import Attraction from './Attraction.jsx'
<<<<<<< HEAD
console.log("city.js loaded")
=======
>>>>>>> 13c3d4b0e2159ebf143982732b51f3b9d47f9332

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
    console.log(this.state.attractions);
    return (
      <div className="city-info">
        <h2>Top attractions in {this.props.cityName}</h2><br />
        {this.state.attractions.map(element => 
            <Attraction
            name={element.name}
            pic={element.photo}
            address={element.address}
            id={element.place_id}
            rating={element.rating}
            />
        )
        }
      </div>
      )

  }
}
