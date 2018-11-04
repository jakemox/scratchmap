class Country {

  constructor(id, code, name, visited) {
    this.id = id;
    this.code = code;
    this.name = name;
    this.visited = false;
  }

}

countriesList = [];

  $.ajax({
  url: '/api/countries',
  method: 'get',
  success: (data) => {
    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        const element = data[key];
        countriesList[key] = new Country(element.id, element.code, element.name)
      }
    }
  }
})

$.ajax({
  url: '/api/visits',
  method: 'get',
  success: (data) => {
    data.forEach(element => {
      countriesList[element.country_id].visited = true
      });
  }
})

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
// AJAX script to insert selection into DB without page refresh
function toggle_visit(country_id) {
  $.ajax({
    url: '/',
    method: 'post',
    data: {
      id: country_id
    }
  });

  let toggle = document.getElementById('country_' + country_id);

  if (toggle.firstElementChild.className == "far fa-circle") {
    toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
  } else {
    toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
  }
}    