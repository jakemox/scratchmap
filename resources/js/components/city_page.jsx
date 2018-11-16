import React from 'react'
import {render} from 'react-dom'
import Axios from 'axios';

console.log('jakes cities');

export default class CityPage extends React.Component {
    
    componentDidMount() {
        Axios.get('/city/api/' + this.props.cityName)
        .then(response => {
            city: response.data.city
        })
    }

    render() {
        console.log('jake');
        return <div>hello</div>;
    }
}