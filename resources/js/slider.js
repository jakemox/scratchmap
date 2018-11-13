document.getElementById('trigger-mobile').addEventListener('click', function() {
let button = document.getElementById('trigger-mobile');
    if(button.innerHTML === 'View as List') {
        button.innerHTML = 'View Map';
    } else {
        button.innerHTML = 'View as List';
    }
});

document.getElementById('trigger-desktop').addEventListener('click', function() {
    let button = document.getElementById('trigger-desktop');
    if(button.innerHTML === 'View as List') {
        button.innerHTML = 'View Map';
    } else {
        button.innerHTML = 'View as List';
    }
});

let slideTriggerDesktop = document.getElementById('trigger-desktop');
slideTriggerDesktop.addEventListener('click', function() {
    let element = document.getElementById('slider');
    element.classList.toggle('close');
});

let slideTriggerMobile = document.getElementById('trigger-mobile');
slideTriggerMobile.addEventListener('click', function() {
    let element = document.getElementById('slider');
    element.classList.toggle('close');
});



