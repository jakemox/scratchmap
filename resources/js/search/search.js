

document.addEventListener('DOMContentLoaded', function () {
    let form = document.getElementById('search-form');
    let label = document.getElementById('search-label');
    console.log('search loaded');
    // let x = window.matchMedia("(max-width: 768px)");
    
    // let clouds = document.getElementById('clouds');
    // let trees = document.getElementById('trees');
    // let slope = document.getElementById('slope');
    // let mountains = document.getElementById('mountains');

    form.addEventListener('mouseover', function () {
        console.log('hovered search');
        label.innerHTML = `<img src="\\img\\search-black.svg" alt="search-icon">`;
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
    })
    
    form.addEventListener('mouseleave', function () {
        label.innerHTML = `<img src="\\img\\search.svg" alt="">`;
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
    })

    // Type-hinting to suggest cities in real time
    let input = document.getElementById('search-input');
    input.addEventListener('keyup', () => {
        fetch('/api/suggest?s=' + encodeURIComponent(input.value), {
            method: 'GET'
        })
        .then((response) => {
            return response.json();
        })
        .then((json) => {
            let container = document.querySelector('#suggestions');
            container.innerHTML = '';

            json.forEach((item) => {

                let div = document.createElement('div');
                div.innerHTML = `<a href="/city/show/${item.name}">${item.name}</a>`;
                container.appendChild(div);
            });

        });
    });
})