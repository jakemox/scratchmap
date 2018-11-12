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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */,
/* 8 */,
/* 9 */,
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(11);
__webpack_require__(15);
module.exports = __webpack_require__(16);


/***/ }),
/* 11 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__country__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__country___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__country__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__search_search_js__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__search_search_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__search_search_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__slider__ = __webpack_require__(14);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__slider___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__slider__);




console.log("index.js loaded");

countryList = [];

$.ajax({
  // populates the countryList with all countries in the database
  url: '/api/countries',
  method: 'get',
  success: function success(data) {
    for (var key in data) {
      if (data.hasOwnProperty(key)) {
        var element = data[key];
        countryList[key] = new __WEBPACK_IMPORTED_MODULE_0__country___default.a(element.id, element.code, element.name);
      }
    }
  },
  complete: function complete() {
    $.ajax({
      // sets the property "visited" to true for countries that this user has saved in the db as visited
      url: '/api/visits',
      method: 'get',
      success: function success(data) {
        data.forEach(function (element) {
          countryList[element.country_id - 1].visited = true;
        });
      }
    });
  }
});

/***/ }),
/* 12 */
/***/ (function(module, exports) {

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

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
        var element = data[key];
        countryList[key] = new Country(element.id, element.code, element.name);
      }
    }
  },
  complete: function complete() {
    $.ajax({
      // sets the property "visited" to true for countries that this user has saved in the db as visited
      url: '/api/visits',
      method: 'get',
      success: function success(data) {
        data.forEach(function (element) {
          countryList[element.country_id - 1].visited = true;
        });
      }
    });
  }
});

/***/ }),
/* 13 */
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
/* 14 */
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
/* 15 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 16 */
/***/ (function(module, exports) {

throw new Error("Module build failed: ModuleBuildError: Module build failed: \r\n}\r\n^\r\n      Invalid CSS after \"}\": expected \"}\", was \"\"\r\n      in C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\resources\\sass\\plan.scss (line 434, column 2)\n    at runLoaders (C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\webpack\\lib\\NormalModule.js:195:19)\n    at C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\loader-runner\\lib\\LoaderRunner.js:364:11\n    at C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\loader-runner\\lib\\LoaderRunner.js:230:18\n    at context.callback (C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\loader-runner\\lib\\LoaderRunner.js:111:13)\n    at Object.asyncSassJobQueue.push [as callback] (C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\sass-loader\\lib\\loader.js:55:13)\n    at Object.done [as callback] (C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\neo-async\\async.js:8077:18)\n    at options.error (C:\\Users\\mateo\\Desktop\\bootcamp\\projects\\scratchmap\\node_modules\\node-sass\\lib\\index.js:294:32)");

/***/ })
/******/ ]);