document.addEventListener('DOMContentLoaded', function () {
    let x = window.matchMedia("(max-width: 768px)");
    let form = document.getElementById('search-form');
    let label = document.getElementById('search-label');
    let clouds = document.getElementById('clouds');
    let trees = document.getElementById('trees');
    let slope = document.getElementById('slope');
    let mountains = document.getElementById('mountains');

    form.addEventListener('mouseover', function () {
        label.innerHTML = `<img src="\\img\\search-black.svg" alt="">`;
        slope.style.left = '-10%';
        
        if (x.matches) {
            trees.style.left = '10%';
            mountains.style.height = '45vh';
            mountains.style.bottom = '5vh';
        } else {
            trees.style.left = 'calc(((100vw - 768px) / 2) + 10%)';
            mountains.style.height = '60vw';
            mountains.style.maxHeight = '80vh';
            mountains.style.bottom = '0';
        }
    })
    
    form.addEventListener('mouseleave', function () {
        label.innerHTML = `<img src="\\img\\search.svg" alt="">`;
        slope.style.left = '0';

        if (x.matches) {
            trees.style.left = '0';
            mountains.style.height = '40vh';
            mountains.style.bottom = '10vh';
        } else {
            trees.style.left = 'calc((100vw - 768px) / 2)';
            mountains.style.height = '50vw';
            mountains.style.maxHeight = '70vh';
            mountains.style.bottom = '0';
        }
    })
})