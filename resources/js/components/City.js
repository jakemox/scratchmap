import React from 'react'
import {render} from 'react-dom'


console.log("city.js loaded")

export default class City extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      name: null
    }

  }

  
  componentDidMount() {

    // fetch(`https://maps.googleapis.com/maps/api/place/textsearch/json?query=prague+attraction&type=point_of_interest&language=en&key=${process.env.MIX_GOOGLE_KEY}`, 
    // {
    //   mode: "cors",
    //   method: "HEAD"
    // })
    // .then(response => response.json())
    // .then(response => {
    //   this.setState(
    //     {name: response.results[0].name}
    //   )
    // })

  }

  render() {
    return "testi"
  }
}

// render(<City />, document.getElementById('map')); 