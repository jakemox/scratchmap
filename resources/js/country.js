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
    this.save();

    let toggle = document.getElementById('country_' + this.id);

    if (toggle.firstElementChild.className == "far fa-circle") { 
      toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
      this.updateMap();
    } else {
      toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
      this.updateMap();
    }
  }


  //to save countries clicked when not logged in.
  save() {
    $.ajax({
      url: '/',
      method: 'post',
      data: {
        id: this.id,
        _token: document.head.querySelector('meta[name="csrf-token"]').content
      }
    }); 
  }

  // get() {
    
  //   if(!window.userId) {
  //     //get from local storage
  //   } else {

  //   }
  // }

  updateList() {
    let toggle = document.getElementById('country_' + this.id);

    if (toggle.firstElementChild.className == "far fa-circle") { 
      toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
    } else {
      toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
    }
  }

  show_features(country) {

    let feats = document.getElementById('features');
    
    feats.innerHTML =
    '<div class="display-name">' +
    '<div class="image-crop">' +   
    '<img class="flag-icon" src="/img/flags-normal/' + this.code.toLowerCase() + '.png" alt="">' +
            '</div>' +
            '<h2>' + this.name + '</h2>' +
            '</div>' +
            '<div id="shape-container" class="shape-container">' +  
            '<img class="shape" src="/img/shapes/' + this.code + '.svg" alt="">' +
            '</div>' +
            '<div id="country-details">' +
            `<p><b>Capital:</b> <a id="cityLink" data-city="${this.capital}" href="javascript:void(0)">` + this.capital + '</a></p>' +
            '<p><b>Population:</b> ' + (this.population/1000000).toFixed(2) + ' million</p>' +
            '<p><b>Currency:</b> ' + this.currency + '</p>' +
            '<p><b>Language:</b> ' + this.language + '</p>' +
            '<p><b>Area:</b> ' + (this.area/1000) + ' km<sup>2</sup></p>' +
            '</div>' +
            '<div id="city"></div>';
            
            
            feats.style.width = "370px";
    } 


  updateMap() {
    let clickedStateId = this.id;
    let clickedStateKey = clickedStateId - 1;
    let selectedIndex = window.scratchmap.clicked.indexOf(clickedStateId);


    if (this.visited == false) {
      window.scratchmap.clicked.push(this);
      this.visited = true;
      window.scratchmap.map.setFeatureState({source: 'states', id: this.id}, {click: this.visited});
      
      this.updateHTML();
      console.log(window.scratchmap.score);
    } else {
      window.scratchmap.clicked.splice(selectedIndex, 1);
      this.visited = false;
      window.scratchmap.map.setFeatureState({source: 'states', id: this.id}, {click: this.visited});
      
      this.updateHTML();
      console.log(window.scratchmap.score);
    }

    console.log(window.scratchmap.clicked);
  }
  
  checked() {
    if(this.visited == false) {
      return `<i class=\"far fa-circle\"></i>`;
    } else {
      return `<i class=\"fas fa-check-circle\"></i>`;
    }
  }
  
  renderList() {
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
      <div id="country_${this.id}" class="country-button">${this.checked()}
      </div>`
    )

    return listCountryItem; 
  }

  mountList(parent) {
    let listCountryElm = this.renderList();
    parent.appendChild(listCountryElm);

    let toggleBtn = document.getElementById(`country_${this.id}`);
    toggleBtn.addEventListener('click', () => {
      this.toggle_visit();
    })
  }

  updateHTML() {
    window.scratchmap.scoreContainer.innerHTML = `<div id="score" class="score">Countries Visited: ${window.scratchmap.clicked.length}</div>`;
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
          countryList[country.country_id -1].visited = true;
          });
      }
    })}
})

