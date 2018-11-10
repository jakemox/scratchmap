import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import mapboxgl from 'mapbox-gl'
import ReactMapGL from 'react-map-gl';
import { fromJS } from 'immutable';

const defaultMapStyle = "mapbox://styles/jakemox99/cjo4t22t8012s2sp2xwb0e0j5";

const token = 'pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA';
mapboxgl.accessToken = token

console.log("example.js loaded")

export default class Mapbox extends React.Component {

  state = {
    mapStyle: defaultMapStyle,
    viewport: {
      width: "100%",
      height: "100%",
      latitude: 37.7577,
      longitude: -122.4376,
      zoom: 8
    }
  };

  render() {
    const {mapStyle} = this.state; 
    return (
      <ReactMapGL

        mapStyle={mapStyle}
        mapboxApiAccessToken='pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA'
        {...this.state.viewport}
        onViewportChange={(viewport) => this.setState({ viewport })}
      />
    );
  }
}

ReactDOM.render(<Mapbox />, document.getElementById('map'));