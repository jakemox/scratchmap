import React from 'react'
import {render} from 'react-dom'
import Axios from 'axios';


console.log("city.js loaded")

export default class City extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      visible: true,
      attractions: []
    }

  }

  
  componentDidMount() {
    Axios.get('/city/show/' + this.props.cityName)
    // .then(response => response.json())
    .then(response => {
      // console.log(response.data.attractions);
      this.setState({
        attractions: response.data.attractions
      })
    })
  }

  render() {
    return (
      <div className="city-info">
        <h2>ATTRACTIONS</h2><br />
        {this.props.cityName}
        {console.log(this.state.attractions[0])}
        {this.state.attractions[0].map()}

      </div>
      )

  }
}
