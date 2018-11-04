@extends('layouts.layout')


@section('content')

<main>
    <div class="sea">
        <div class='map' id='map'>
             <a href="#"><div id="trigger-mobile"  class='listview-mobile'>View as List</div></a> 
             <a href="#"><div id="trigger-desktop" class='listview-desktop'>View as List</div></a>
             <div id="slider" class="slider close">
            @include('list')

                 </div>    
            </div>
    </div>
   
    <div class='features' id='features'></div>
    
</main>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/jakemox99/cjnomdfut1ea32spgv0umdu84',
            collectResourceTiming: true,
            maxBounds: [ [-180, -70], [180, 90] ]
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
                "data": "{{ asset('countries.geojson') }}",
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

            let rendered = false;

            // render countries saved in db as clicked
            
            map.on("render", "done-fills", function() {
                //only render once.
                if (!rendered) {
                    @foreach($visited_countries as $country)
                        clicked.push({{$country->country_id}});
                    @endforeach
                    console.log(clicked);
                    
                    clicked.forEach(country => {
                        map.setFeatureState({source: "states", id:country}, {click: true });
                    });
                }
                rendered = true; //prevents rendering >1.
            })

            
            map.on("click", "done-fills", function(e) {
                randomColour();
                console.log(colour);
                clickedStateId = e.features[0].id;
                
                let selectedIndex = clicked.indexOf(clickedStateId);
                console.log(selectedIndex);
                console.log(clickedStateId);

                let state = false;
                $.ajax({
                    url: '/',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: clickedStateId
                    }
                })

                if (selectedIndex == -1) {
                    clicked.push(clickedStateId);
                    state = true;
                    //creates new country record.
                
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

                    // console.log(hoveredStateId);

                    map.setFeatureState({source: 'states', id: hoveredStateId}, { hover: true});

                    let million = (e.features[0].properties.POP_EST/1000000).toFixed(2);

                    let countries = <?php echo json_encode($countries);?>;
                    
                    //shows name of country in box

                    document.getElementById('features').innerHTML = 
                        '<div class="display-name">' +
                            '<div class="image-crop">' +   
                                '<img class="flag-icon" src="/img/flags-normal/' + (countries[(hoveredStateId - 1)].code).toLowerCase() + '.png" alt="">' +
                            '</div>' +
                            '<h2>' + countries[hoveredStateId - 1].name + '</h2>' +
                        '</div>' +
                        '<img class="shape" src="/img/shapes/' + countries[(hoveredStateId - 1)].code + '.svg" alt="">' +
                        '<p>json id: ' + e.features[0].id + '</p>' +
                        '<p>db id: ' + countries[hoveredStateId - 1].id + '</p>' +
                        '<p> Population: ' + million + ' million</p>';
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
