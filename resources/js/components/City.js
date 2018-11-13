import React from 'react'

export default class City extends React.Component {
  componentDidMount() {
    fetch(`https://maps.googleapis.com/maps/api/place/textsearch/json?query=prague+attraction&type=point_of_interest&language=en&key=${process.env.MIX_GOOGLE_KEY}`)
    .then(response => response.json())
    .then(console.log(json))
  }

  render() {
    return json;
  }
}