import React from 'react'
import {render} from 'react-dom'


export default class Attraction extends React.Component {


  render() {
    let style = {
      backgroundImage: "url("+this.props.pic+")",
      };

    let url = 'https://www.google.com/maps/place/?q=place_id:' + this.props.id;

    return(
      
        <div id="attraction">
          <div id="attraction-pic" style={style}>
          <div className="darkener">

            <h6>{this.props.name}</h6>
            </div>
          </div>
          
          Address: <a target="_blank" href={url}> {this.props.address}</a><br />
          Google rating: {this.props.rating}
        </div>
        
    )
  }
}