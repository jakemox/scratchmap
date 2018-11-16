import React from 'react'
import {render} from 'react-dom'
// import '../../views/city.blade.php'
import CityPage from './components/city_page.jsx'

document.addEventListener('DOMContentLoaded', function () {
    let appCity = document.getElementById('app-city');
    appCity.innerHTML = '<div id="cityView"></div>';

    function show_city(city) {
        render(<CityPage cityName={city} />, document.getElementById('cityView'));
    };
})

