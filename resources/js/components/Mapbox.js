import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import mapboxgl from 'mapbox-gl'
import ReactMapGL from 'react-map-gl';
import { fromJS } from 'immutable';
import { defaultMapStyle, dataLayer } from './mapstyle.js';


// const defaultMapStyle = "mapbox://styles/jakemox99/cjo4t22t8012s2sp2xwb0e0j5";

const token = 'pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA';
mapboxgl.accessToken = token

console.log(defaultMapStyle)
console.log("example.js loaded")

export default class Mapbox extends React.Component {

  state = {
    data: null,
    mapStyle: {defaultMapStyle, 
      layers: [],
    },
      // sources: [
      //   {
      //     "states" : {
      //           "type": "geojson",
      //           "data": "{{ asset('countries.geojson') }}",
      //           "generateId": true //adds id to each country's properties based on index.
      //       }
      //   }
      // ],
      // layers: 
      //   [{"id": "done-fills",
      //   "type": "fill",
      //   "source": "states",
      //   "layout": {},
      //   "paint": {
      //       "fill-color": "#ffd294",
      //       "fill-opacity": ["case",
      //           ["boolean", ["feature-state", "click"], false],
      //           0,
      //           1
      //       ]}
      //   }]
      // },
    viewport: {
      width: "100%",
      height: "100%",
      latitude: 37.7577,
      longitude: 40,
      zoom: 1
    }
  };

  componentDidMount() {
    fetch('countries.geojson') 
      .then((response) => {
        return response.json()
      })
      .then((json) => {
        console.log(json);
        this._loadData(json);
      })
    };
  
  _loadData = data => {

    const mapStyle = defaultMapStyle
      // Add geojson source to map
      .setIn(['sources', 'states'], fromJS({ type: 'geojson', data }))
      // Add point layer to map
      .set('layers', defaultMapStyle.get('layers').push(dataLayer));

    this.setState({ data, mapStyle });
    console.log(this.state)
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