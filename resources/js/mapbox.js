mapboxgl.accessToken = process.env.MIX_MAPBOX_TOKEN;

var map = new mapboxgl.Map({
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
var clicked = [];
let colours = ['#00D84A', '#00DA65', '#00DA29'];
function randomColour() {
    return colours[Math.floor(Math.random() * colours.length)]
};
let colour = randomColour();
console.log(colour);

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
            countryList.forEach(country => {
                if(country.visited === true)
                  {
                    clicked.push(country);   
                  }
            });

            clicked.forEach(country => {
                map.setFeatureState({source: "states", id:country.id}, {click: true });
            });
        }
        let loading = document.getElementById('loading');
        loading.style.display= 'none'; 
        rendered = true; //prevents rendering >1.
    })

    let score = 0;

    map.on("click", "done-fills", function(e) {

        randomColour();
        console.log(colour);
        let clickedStateId = e.features[0].id;
        let clickedStateKey = clickedStateId - 1;
        let country = countryList[clickedStateKey]
        let selectedIndex = clicked.indexOf(clickedStateId);
        let state = false;

        console.log(countryList[clickedStateKey]);
        
        axios.post('/', {
            id: country.id
        })
        
        if (country.visited == false) {
            clicked.push(country.id);
            state = true;
            country.visited = true;
            //creates new country record.
        
        } else {
            clicked.splice(selectedIndex, 1);
            country.visited = false;

        }

        console.log(clicked);
        map.setFeatureState({source: 'states', id: country.id}, {click: state});

        
        let scoreHTML = document.getElementById('score');

            if(selectedIndex == -1) {
                score += 100;
                scoreHTML.innerHTML = `Score: ${score}`;
            } else {
                score -= 100;
                scoreHTML.innerHTML = `Score: ${score}`;
            } 

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
            
            //shows name of country in box

            document.getElementById('features').innerHTML = 
                '<div class="display-name">' +
                    '<div class="image-crop">' +   
                        '<img class="flag-icon" src="/img/flags-normal/' + (countries[(hoveredStateId - 1)].code).toLowerCase() + '.png" alt="">' +
                    '</div>' +
                    '<h2>' + countries[hoveredStateId - 1].name + '</h2>' +
                '</div>' +
                '<div class="shape-container">' +  
                    '<img class="shape" src="/img/shapes/' + countries[(hoveredStateId - 1)].code + '.svg" alt="">' +
                '</div>' +
                '<p><b>Capital:</b> ' + countries[(hoveredStateId - 1)].capital + '</p>' +
                '<p><b>Population:</b> ' + (countries[(hoveredStateId - 1)].population/1000000).toFixed(2) + ' million</p>' +
                '<p><b>Currency:</b> ' + countries[(hoveredStateId - 1)].currency + '</p>' +
                '<p><b>Language:</b> ' + countries[hoveredStateId - 1].language + '</p>' +
                '<p><b>Area:</b> ' + (countries[(hoveredStateId - 1)].area/1000) + ' km<sup>2</sup></p>';
        }
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