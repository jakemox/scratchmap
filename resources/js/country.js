class Country {

  constructor(id, code, name, visited) {
    this.id = id;
    this.code = code;
    this.name = name;
    this.visited = false;
  }

  toggle_visit(id) {
    $.ajax({
      url: '/',
      method: 'post',
      data: {
        id: this.id,
        _token: document.head.querySelector('meta[name="csrf-token"]').content
      }
    });

    let toggle = document.getElementById('country_' + this.id);

    if (toggle.firstElementChild.className == "far fa-circle") {
      toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
    } else {
      toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
    }
  }     

}

countryList = [];

  $.ajax({
    // populates the countryList with all countries in the database
  url: '/api/countries',
  method: 'get',
  success: (data) => {
    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        const element = data[key];
        countryList[key] = new Country(element.id, element.code, element.name)
      }
    }
  },
  complete: () => {
    $.ajax({
      // sets the property "visited" to true for countries that this user has saved in the db as visited
      url: '/api/visits',
      method: 'get',
      success: (data) => {
        data.forEach(element => {
          countryList[element.country_id -1].visited = true
          });
      }
    })}
})

