import {render} from 'react-dom'
import React from 'react'
import City from './components/City.jsx'
 

mapboxgl.accessToken = process.env.MIX_MAPBOX_TOKEN;

var map = window.scratchmap.map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/jakemox99/cjoctcplm26gg2rrrrxp4o3gi',
    collectResourceTiming: true,
    maxBounds: [ [-180, -70], [180, 90] ],
    zoom: 0,
    center: [45, 45]
 
});

var nav = new mapboxgl.NavigationControl();
map.addControl(nav, 'top-left');

var hoveredStateId =  null;
var clicked = window.scratchmap.clicked = [];
let score = 0;
var scoreContainer = window.scratchmap.scoreContainer = document.getElementById('score-container');
let countryListView = document.getElementById('country-list');



map.on('load', function () {   
    map.addSource("states", {
        "type": "geojson",
        "data": 'countries-simple.geojson',
        "generateId": true //adds id to each country's properties based on index.
    });
    
    //layer for countries that have been clicked.
    map.addLayer({
        "id": "done-fills",
        "type": "fill",
        "source": "states",
        "layout": {},
        "paint": {
            "fill-color": "#ffd294",
            "fill-opacity": ["case",
                ["boolean", ["feature-state", "click"], false],
                0,
                1
            ]
        }
    });

    // The feature-state dependent fill-opacity expression will render the hover effect
    // when a feature's hover state is set to true.
    
    map.addLayer({
        "id": "hover-fills",
        "type": "fill",
        "source": "states",
        "layout": {},
        "paint": {
            "fill-color": "#A80000",
            "fill-opacity": ["case",
                ["boolean", ["feature-state", "hover"], false],
                1,
                0
            ]
        }
    });

    map.addLayer({
        "id": "state-borders",
        "type": "line",
        "source": "states",
        "layout": {},
        "paint": {
            "line-color": "#fff3df",
            "line-width": 0.3,
            "line-opacity": ["case",
                ["boolean", ["feature-state", "click"], false],
                0,
                1
            ]
        }
    });

    let rendered = false;

    // render countries saved in db as clicked
    
    map.on("render", "done-fills", () => {
        //only render once.
        if (!rendered) {
            let loading = document.getElementById('loading');
            loading.style.display= 'none';
            
            countryList.forEach(country => {
                if(country.visited === true)
                  {
                    clicked.push(country);   
                  }
            });

            clicked.forEach(country => {
                map.setFeatureState({source: "states", id:country.id}, {click: true });
            });

            score = clicked.length;
                
            if (score > 0) {
                scoreContainer.innerHTML = `<div id="score" class="score">Countries Visited: ${score}</div>`;
            } else {
                scoreContainer.innerHTML = '';
            }

            countryList.forEach(country => {
                country.mountList(countryListView);
            })

            let continents = document.getElementsByClassName('continent');
            //creates array.

            for(let i=0; i<continents.length; i++) {   
                continents[i].addEventListener('click', () => {
                    countryListView.innerHTML = '';
                    countryList.forEach(country => {
                        if(country.continent == continents[i].getAttribute('id')) {
                            country.mountList(countryListView);
                        }
                    })
                })
            }

            

        }
        rendered = true; //prevents rendering >1.   
    })

    map.on("click", "done-fills", function(e) {

        let clickedStateId = e.features[0].id;
        let clickedStateKey = clickedStateId - 1;
        let country = countryList[clickedStateKey]
        let selectedIndex = clicked.indexOf(clickedStateId);
        let state = false;

        console.log(countryList[clickedStateKey]);
        
        // if(!window.userId) {
        //     //write to local storage
        //     console.log('writing to local storage');
        // } else {
            
        // }

        axios.post('/', {
            id: country.id
        })
        
        if (country.visited == false) {
            clicked.push(country);
            state = true;
            country.visited = true;
            country.updateList();
            //creates new country record.
        
        } else {
            clicked.splice(selectedIndex, 1);
            country.visited = false;
            country.updateList();
        }

        console.log(clicked);
        map.setFeatureState({source: 'states', id: country.id}, {click: state});

        
    

        score = clicked.length;

        scoreContainer.innerHTML = `<div id="score" class="score">Countries Visited: ${score}</div>`;

            if (score == 1000) {
                let badge = document.getElementById('badge');
                badge.style.display = 'block'; 
            }
        
    });

    // When the user moves their mouse over the state-fill layer, we'll update the
    // feature state for the feature under the mouse.
    map.on("mousemove", "hover-fills", function(e) {
        if (e.features.length > 0) {
            if (hoveredStateId) {
                map.setFeatureState({source: 'states', id: hoveredStateId}, { hover: false});
            }
            
            hoveredStateId = e.features[0].id;

            map.setFeatureState({source: 'states', id: hoveredStateId}, { hover: true});

            let countries = countryList;
            let country = countries[(hoveredStateId - 1)];

            //shows information of country in the box

            country.show_features();            
        }

            function show_city(city) {
                document.getElementById('shape-container').setAttribute('style','display:none');
                document.getElementById('country-details').setAttribute('style','display:none');
                render(<City cityName={city} />, document.getElementById('city'));
            };
    });

    // When the mouse leaves the state-fill layer, update the feature state of the
    // previously hovered feature.
    map.on("mouseleave", "hover-fills", function() {
        if (hoveredStateId) {
            map.setFeatureState({source: 'states', id: hoveredStateId}, { hover: false});
        }
        hoveredStateId =  null;
    });
});