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
