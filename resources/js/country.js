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