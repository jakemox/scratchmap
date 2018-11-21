@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'city'
])


@section('content')

<main>
    
    <div class="header-background" style="background-image: url('{{$city[0]->photo}}')">
        <div class="fade">
            <div class="name">
                <h3>{{$city_name}}</h3>
                <h4>{{$country[0]->name}}</h4>
            </div>
        </div>
    </div>

    <button id="down-arrow" class="down-arrow"><img src="\img\down-arrow.svg" alt=""></button>
    

    
    <div class="attractions">



        <h1>Top attractions in {{$city_name}}</h1>
        
        

        <div class="carousel">

            {{-- <button id="btnLeft"><</button> --}}

            {{-- <div id="carousel"></div> --}}

            @foreach ($attractions as $key => $attraction)
                <div class="carousel-background" style="background-image: url('{{$attraction['photo']}}')">
                    <div class="darkener">
                        <h5>{{$attraction['name']}}</h5>
                        <img src="\img\balloon-{{$key + 1}}.svg"/>
                        <p>Rating: {{$attraction['rating']}}</p>
                    </div>
                </div>
            @endforeach

            {{-- <button id="btnRight">></button> --}}
        </div>

        <div class="city-map">
            <img src="https://api.mapbox.com/styles/v1/jakemox99/cjorqs6d032z52smeej16xcuq/static/{{$city[0]->longitude}},{{$city[0]->latitude}},13.0,0,0/1000x1000?access_token=pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA" alt="">
        </div>
        
        {{-- <a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
            
        <img src="{{$attraction['photo']}}"><br>
        Address: {{$attraction['address']}}<br>
        Rating: {{$attraction['rating']}}<hr> --}}
        <div class="footer">
            <div class="logo">
                {{-- <img src="/img/balloon-cutout.svg" alt=""> --}}
                <p>ScratchMapp</p>
            </div>
            <p>© Tomi Holstila, Mateo Milic, Jake Moxon </p>
        </div>
    </div>

    


</main>

{{-- <script>
    console.log('city index loaded');

    let pageHeight = window.innerHeight;

    let downBtn = document.getElementById('down-arrow');
    downBtn.addEventListener('click', function () {
        window.scrollTo({
            top: pageHeight,
            behavior: 'smooth'
        });
    })
</script> --}}

{{-- <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
				
{{-- <script>
// $(document).ready(function(){
//   $('.carousel').slick({
//     // setting-name: setting-value
//   });
// });
		
    let carousel = document.getElementById('carousel');

    // import Attraction from './cityindex';
    
    class Attraction {
    constructor(city, name, number, rating, image, visible) {
        this.city = city;
        this.name = name;
        this.number = number;
        this.rating = rating;
        this.image = image;
        this.visible = false;
    }
    // toString() {
    //     return 'I am na object of Attraction class'
    //     return this.city + ' ' + this.name + ' with rating ' + this.rating;
    // }
    

    render() {
        let carouselItem = document.createElement('div');
        carouselItem.setAttribute('class', 'carousel-background');
        carouselItem.style.backgroundImage = `url('${this.image}')`;
        // carouselItem.style.height = '400px';
        // carouselItem.style.width = '400px';

        carouselItem.innerHTML = (
            `<h5>${this.name}</h5>
            <p>${this.number}</p>
            <p>Rating: ${this.rating}</p>`
        )

        return carouselItem;
    }

    mount(parent) {
        let carouselElm = this.render();
        parent.appendChild(carouselElm);
    }

}
    let attractionList = [];



    fetch('/city/api/{{$city_name}}')
        .then(response => response.json())
        .then(json => {
            // let myList = document.getElementById('my-list');
            json.attractions.forEach((attr,key) => {
                attractionList.push(new Attraction(attr.city_name,attr.name,(key + 1),attr.rating,attr.photo));
            });
            // console.log(json.attractions);
            console.log('attractionList: ' + attractionList);
        });

        attractionList.forEach(item => {
            item.mount(carousel);
        })
</script> --}}


@endsection
