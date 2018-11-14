console.log("renderCountrInfo loaded")

export default function renderCountryInfo(country)
{
document.getElementById('features').innerHTML = 
    '<div class="display-name">' +
        '<div class="image-crop">' +   
            '<img class="flag-icon" src="/img/flags-normal/' + (country.code).toLowerCase() + '.png" alt="">' +
        '</div>' +
        '<h2>' + country.name + '</h2>' +
    '</div>' +
    '<div class="shape-container">' +  
        '<img class="shape" src="/img/shapes/' + country.code + '.svg" alt="">' +
    '</div>' +
    '<p><b>Capital:</b> <a onClick="show_city('+ country.capital+')">' + country.capital + '</a></p>' +
    '<p><b>Population:</b> ' + (country.population/1000000).toFixed(2) + ' million</p>' +
    '<p><b>Currency:</b> ' + country.currency + '</p>' +
    '<p><b>Language:</b> ' + country.language + '</p>' +
    '<p><b>Area:</b> ' + (country.area/1000) + ' km<sup>2</sup></p>'
}