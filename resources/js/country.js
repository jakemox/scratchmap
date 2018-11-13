class Country {

  constructor(id, code, name, capital, population, currency, language, area, continent, visited) {
    this.id = id;
    this.code = code;
    this.name = name;
    this.capital = capital;
    this.population = population;
    this.currency = currency;
    this.language = language;
    this.area = area;
    this.continent = continent;
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
      this.visited = true;
      clicked.push(this.id);
    } else {
      toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
    }
  }

  updateMap() {
    // let clickedStateId = this.id;
    // let clickedStateKey = clickedStateId - 1;
    // let country = countryList[clickedStateKey]
    // let selectedIndex = clicked.indexOf(clickedStateId);
    // let state = false;
    
    // if (this.visited == false) {
    //   clicked.push(this.id);
    //   state = true;
    //   this.visited = true;
    //   //creates new country record.
    // } 
  }
  
  checked() {
    if(this.visited == false) {
      return `<i class=\"far fa-circle\"></i>`;
    } else {
      return `<i class=\"fas fa-check-circle\"></i>`;
    }
  }
  
  renderList() {
    console.log(this.name);
    let listCountryItem = document.createElement('li');
    listCountryItem.setAttribute('class', 'list-country-item');
    
    listCountryItem.innerHTML = (
      `<div class="country-list">
        <div class="image-crop">
          <img class="flag-icon" src="/img/flags-normal/${this.code.toLowerCase()}.png">
        </div>
        <div class="list-country-name">
          ${this.name}
        </div>
      </div>
      <div id="country_${this.id}" class="country-button" onclick="countryList[${this.id - 1}].toggle_visit()">${this.checked()}
      </div>`
    )

    return listCountryItem; 
  }

  mountList(parent) {
    let listCountryElm = this.renderList();
    parent.appendChild(listCountryElm);
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
        const country = data[key];
        countryList[key] = new Country(country.id, country.code, country.name, country.capital, country.population,  country.currency, country.language, country.area, country.CONTINENT)
      }
    }
  },
  complete: () => {
    $.ajax({
      // sets the property "visited" to true for countries that this user has saved in the db as visited
      url: '/api/visits',
      method: 'get',
      success: (data) => {
        data.forEach(country => {
          countryList[country.country_id -1].visited = true
          });
      }
    })}
})

