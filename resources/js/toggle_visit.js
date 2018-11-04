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