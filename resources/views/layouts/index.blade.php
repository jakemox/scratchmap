@extends('layout')

@section('content')
<div class="sea">
    <div class='map' id='map'></div>
    <div class='features' id='features'></div>
</div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/jakemox99/cjnomdfut1ea32spgv0umdu84',
            collectResourceTiming: true
            
        });

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
                "data": "{{ asset('ne_10m_admin_1_countries.geojson') }}",
                "generateId": true //adds id to each country's properties based on index.
            });

            
            //layer for countries that have been clicked.
            map.addLayer({
                "id": "done-fills",
                "type": "fill",
                "source": "states",
                "layout": {},
                "paint": {
                    "fill-color": "#00DA65",
                    "fill-opacity": ["case",
                        ["boolean", ["feature-state", "click"], false],
                        1,
                        0
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
                    "line-color": "#FFD48B",
                    "line-width": 1,
                    "line-opacity": ["case",
                        ["boolean", ["feature-state", "click"], false],
                        1,
                        0
                    ]
                }
            });

            map.on("click", "done-fills", function(e) {
                randomColour();
                console.log(colour);
                clickedStateId = e.features[0].id;
                
                let selectedIndex = clicked.indexOf(clickedStateId);

                let state = false;

                if (selectedIndex == -1) {
                    clicked.push(clickedStateId);
                    state = true;
                } else {
                    clicked.splice(selectedIndex, 1);
                }


                console.log(clicked);
                map.setFeatureState({source: 'states', id: clickedStateId}, {click: state});
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

                    
                    //shows name of country in box
                    document.getElementById('features').innerHTML = e.features[0].properties.sovereignt;
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

    </script>

@endsection
