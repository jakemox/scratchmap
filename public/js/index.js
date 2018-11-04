class Country {

  constructor(id) {
    this.id = id;
  }

}

countriesArray = []

  $.ajax({
  url: '/api',
  method: 'get',
  success: (data) => {
    data.forEach(element => {
      console.log(element.id)
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