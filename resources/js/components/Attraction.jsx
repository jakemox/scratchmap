import React from 'react'
import {render} from 'react-dom'

console.log('attraction loaded')

export default class Attraction extends React.Component {


  render() {
    let style = {
      backgroundImage: "url("+this.props.pic+")",
      };

    return(
        <div id="attraction" style={style}>
          {/* <img src={this.props.pic}/><br /> */}
          {this.props.name}
        </div>
    )
  }
}