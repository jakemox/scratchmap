/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__country__ = __webpack_require__(41);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__country___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__country__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__search_search_js__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__search_search_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__search_search_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__slider__ = __webpack_require__(43);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__slider___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__slider__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__mapbox__ = __webpack_require__(44);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__mapbox___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__mapbox__);





console.log("pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA");

console.log("index.js loaded");

/***/ }),

/***/ 41:
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Country = function () {
  function Country(id, code, name, visited) {
    _classCallCheck(this, Country);

    this.id = id;
    this.code = code;
    this.name = name;
    this.visited = false;
  }

  _createClass(Country, [{
    key: 'toggle_visit',
    value: function toggle_visit(id) {
      $.ajax({
        url: '/',
        method: 'post',
        data: {
          id: this.id,
          _token: document.head.querySelector('meta[name="csrf-token"]').content
        }
      });

      var toggle = document.getElementById('country_' + this.id);

      if (toggle.firstElementChild.className == "far fa-circle") {
        toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
      } else {
        toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
      }
    }
  }]);

  return Country;
}();

countryList = [];

$.ajax({
  // populates the countryList with all countries in the database
  url: '/api/countries',
  method: 'get',
  success: function success(data) {
    for (var key in data) {
      if (data.hasOwnProperty(key)) {
        var country = data[key];
        countryList[key] = new Country(country.id, country.code, country.name);
      }
    }
  },
  complete: function complete() {
    $.ajax({
      // sets the property "visited" to true for countries that this user has saved in the db as visited
      url: '/api/visits',
      method: 'get',
      success: function success(data) {
        data.forEach(function (country) {
          countryList[country.country_id - 1].visited = true;
        });
      }
    });
  }
});

/***/ }),

/***/ 42:
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function () {
    var x = window.matchMedia("(max-width: 768px)");
    var form = document.getElementById('search-form');
    var label = document.getElementById('search-label');
    var clouds = document.getElementById('clouds');
    var trees = document.getElementById('trees');
    var slope = document.getElementById('slope');
    var mountains = document.getElementById('mountains');

    form.addEventListener('mouseover', function () {
        label.innerHTML = '<img src="\\img\\search-black.svg" alt="">';
        slope.style.left = '-5%';
        mountains.style.width = '110%';
        mountains.style.left = '-5%';
        trees.style.left = '5%';

        if (x.matches) {
            mountains.style.height = '45vh';
            mountains.style.bottom = '5vh';
        } else {
            mountains.style.height = '60vw';
            mountains.style.maxHeight = '80vh';
            mountains.style.bottom = '0';
        }
    });

    form.addEventListener('mouseleave', function () {
        label.innerHTML = '<img src="\\img\\search.svg" alt="">';
        slope.style.left = '0';
        mountains.style.width = '100%';
        mountains.style.left = '0';
        trees.style.left = '0';

        if (x.matches) {
            mountains.style.height = '40vh';
            mountains.style.bottom = '10vh';
        } else {
            mountains.style.height = '50vw';
            mountains.style.maxHeight = '70vh';
            mountains.style.bottom = '0';
        }
    });
});

/***/ }),

/***/ 43:
/***/ (function(module, exports) {

document.getElementById('trigger-mobile').addEventListener('click', function () {
    var button = document.getElementById('trigger-mobile');
    if (button.innerHTML === 'View as List') {
        button.innerHTML = 'View Map';
    } else {
        button.innerHTML = 'View as List';
    }
});

document.getElementById('trigger-desktop').addEventListener('click', function () {
    var button = document.getElementById('trigger-desktop');
    if (button.innerHTML === 'View as List') {
        button.innerHTML = 'View Map';
    } else {
        button.innerHTML = 'View as List';
    }
});

var slideTriggerDesktop = document.getElementById('trigger-desktop');
slideTriggerDesktop.addEventListener('click', function () {
    var element = document.getElementById('slider');
    element.classList.toggle('close');
});

var slideTriggerMobile = document.getElementById('trigger-mobile');
slideTriggerMobile.addEventListener('click', function () {
    var element = document.getElementById('slider');
    element.classList.toggle('close');
});

/***/ }),

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

mapboxgl.accessToken = "pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA";

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/jakemox99/cjoctcplm26gg2rrrrxp4o3gi',
    collectResourceTiming: true,
    maxBounds: [[-180, -70], [180, 90]],
    zoom: 0,
    center: [45, 45],
    hash: true
});

var spinnerEl = document.getElementById('spinner');
var backgroundEl = document.getElementById('loading-background');
var nav = new mapboxgl.NavigationControl();
map.addControl(nav, 'top-left');

var hoveredStateId = null;
var clicked = [];
var colours = ['#00D84A', '#00DA65', '#00DA29'];
function randomColour() {
    return colours[Math.floor(Math.random() * colours.length)];
};
var colour = randomColour();
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
            "fill-opacity": ["case", ["boolean", ["feature-state", "click"], false], 0, 1]
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
            "fill-opacity": ["case", ["boolean", ["feature-state", "hover"], false], 1, 0]
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
            "line-opacity": ["case", ["boolean", ["feature-state", "click"], false], 0, 1]
        }
    });

    var rendered = false;

    // render countries saved in db as clicked

    map.on("render", "done-fills", function () {
        // let visited_countries = 
        //only render once.
        if (!rendered) {
            // @foreach($visited_countries as $country)
            countryList.forEach(function (country) {
                if (country.visited === true) {
                    clicked.push(country);
                }
            });

            console.log(clicked);
            console.log("country list to render");

            clicked.forEach(function (country) {
                map.setFeatureState({ source: "states", id: country.id }, { click: true });
            });
        }
        var loading = document.getElementById('loading');
        loading.style.display = 'none';
        rendered = true; //prevents rendering >1.
    });

    var score = 0;

    map.on("click", "done-fills", function (e) {

        randomColour();
        console.log(colour);
        var clickedStateId = e.features[0].id;
        var clickedStateKey = clickedStateId - 1;
        var country = countryList[clickedStateKey];
        var selectedIndex = clicked.indexOf(clickedStateId);
        var state = false;

        console.log(countryList[clickedStateKey]);

        axios.post('/', {
            id: country.id
        });

        // $.ajax({
        //     url: '/',
        //     method: 'post',
        //     data: {
        //         _token: "{{ csrf_token() }}",
        //         id: country.id
        //     }
        // })


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
        map.setFeatureState({ source: 'states', id: country.id }, { click: state });

        var scoreHTML = document.getElementById('score');

        if (selectedIndex == -1) {
            score += 100;
            scoreHTML.innerHTML = 'Score: ' + score;
        } else {
            score -= 100;
            scoreHTML.innerHTML = 'Score: ' + score;
        }

        if (score == 1000) {
            var badge = document.getElementById('badge');
            badge.style.display = 'block';
        }
    });

    // When the user moves their mouse over the state-fill layer, we'll update the
    // feature state for the feature under the mouse.
    map.on("mousemove", "hover-fills", function (e) {
        if (e.features.length > 0) {
            if (hoveredStateId) {
                map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: false });
            }

            hoveredStateId = e.features[0].id;

            // console.log(hoveredStateId);

            map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: true });

            // let population = ;

            // let countries = <?php echo json_encode($countries);?>;
            var countries = countryList;

            //shows name of country in box

            document.getElementById('features').innerHTML = '<div class="display-name">' + '<div class="image-crop">' + '<img class="flag-icon" src="/img/flags-normal/' + countries[hoveredStateId - 1].code.toLowerCase() + '.png" alt="">' + '</div>' + '<h2>' + countries[hoveredStateId - 1].name + '</h2>' + '</div>' + '<div class="shape-container">' + '<img class="shape" src="/img/shapes/' + countries[hoveredStateId - 1].code + '.svg" alt="">' + '</div>' + '<p><b>Capital:</b> ' + countries[hoveredStateId - 1].capital + '</p>' + '<p><b>Population:</b> ' + (countries[hoveredStateId - 1].population / 1000000).toFixed(2) + ' million</p>' + '<p><b>Currency:</b> ' + countries[hoveredStateId - 1].currency + '</p>' + '<p><b>Language:</b> ' + countries[hoveredStateId - 1].language + '</p>' + '<p><b>Area:</b> ' + countries[hoveredStateId - 1].area / 1000 + ' km<sup>2</sup></p>';
        }
    });

    // When the mouse leaves the state-fill layer, update the feature state of the
    // previously hovered feature.
    map.on("mouseleave", "hover-fills", function () {
        if (hoveredStateId) {
            map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: false });
        }
        hoveredStateId = null;
    });
});

/***/ })

/******/ });