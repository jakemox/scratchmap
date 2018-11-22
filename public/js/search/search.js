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
/******/ 	return __webpack_require__(__webpack_require__.s = 59);
/******/ })
/************************************************************************/
/******/ ({

/***/ 59:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(60);


/***/ }),

/***/ 60:
/***/ (function(module, exports) {

// let slug = window.location.pathname;

if (slug == "/search") {

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('search-form');
        var label = document.getElementById('search-label');
        console.log('search loaded');
        // let x = window.matchMedia("(max-width: 768px)");

        // let clouds = document.getElementById('clouds');
        // let trees = document.getElementById('trees');
        // let slope = document.getElementById('slope');
        // let mountains = document.getElementById('mountains');

        form.addEventListener('mouseover', function () {
            console.log('hovered search');
            label.innerHTML = '<img src="\\img\\search-black.svg" alt="search-icon">';
            // slope.style.left = '-5%';
            // mountains.style.width = '110%';
            // mountains.style.left = '-5%';
            // trees.style.left = '5%';

            // if (x.matches) {
            //     mountains.style.height = '45vh';
            //     mountains.style.bottom = '5vh';
            // } else {
            //     mountains.style.height = '60vw';
            //     mountains.style.maxHeight = '80vh';
            //     mountains.style.bottom = '0';
            // }
        });

        form.addEventListener('mouseleave', function () {
            label.innerHTML = '<img src="\\img\\search.svg" alt="">';
            // slope.style.left = '0';
            // mountains.style.width = '100%';
            // mountains.style.left = '0';
            // trees.style.left = '0';

            // if (x.matches) {
            //     mountains.style.height = '40vh';
            //     mountains.style.bottom = '10vh';
            // } else {
            //     mountains.style.height = '50vw';
            //     mountains.style.maxHeight = '70vh';
            //     mountains.style.bottom = '0';
            // }
        });

        // Type-hinting to suggest cities in real time
        var input = document.getElementById('search-input');
        input.addEventListener('keyup', function () {
            var isEmpty = null;
            if (!encodeURIComponent(input.value)) {
                // hides suggestions is no string provided
                isEmpty = true;
            } else {
                isEmpty = false;
            }

            fetch('/api/suggest?s=' + encodeURIComponent(input.value), {
                method: 'GET'
            }).then(function (response) {
                return response.json();
            }).then(function (json) {
                var container = document.querySelector('#suggestions');
                if (isEmpty == true) {
                    container.setAttribute('style', 'display:none');
                } else {
                    container.setAttribute('style', 'display:block');
                }

                container.innerHTML = '';

                json.forEach(function (item) {

                    var div = document.createElement('div');
                    div.innerHTML = '<a href="/city/show/' + item.name + '">' + item.name + '</a>';
                    container.appendChild(div);
                });
            });
        });
    });
}

/***/ })

/******/ });