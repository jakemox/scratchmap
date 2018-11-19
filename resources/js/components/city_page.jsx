import React from 'react'
import {render} from 'react-dom'
import Axios from 'axios';

console.log('jakes cities');

export default class CityPage extends React.Component {
    
    componentDidMount() {
        Axios.get('/city/api/' + this.props.cityPageName)
        .then(response => {
            city: response.data.cityPageName
        })
    }

    render() {
        console.log(this.props.cityPageName);
        
        
        // return (
        //     <>
        //         <div class="header-background" style="background-image: url('{{$city[0]->photo}}')">
        //             <div class="fade">
        //                 <div class="name">
        //                     <h3>{{$city_name}}</h3>
        //                     <h4>{{$country[0]->name}}</h4>
        //                 </div>
        //             </div>
        //         </div>
                
        //         <div class="attractions">
        //             <h1>Top attractions in {{$city_name}}, {{$country[0]->name}}</h1>
                    
                    
        //             @foreach ($attractions as $key => $attraction)
        //             <a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
                        
        //             <img src="{{$attraction['photo']}}"><br>
        //             Address: {{$attraction['address']}}<br>
        //             Rating: {{$attraction['rating']}}<hr>
        //             @endforeach
        //         </div>
        //     </>
        // );
    }
}