import Country from './country'
import './slider'

console.log("index.js loaded")

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
