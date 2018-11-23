if(slug == "city") {

document.addEventListener('DOMContentLoaded', function () {

    let pageHeight = window.innerHeight;

    let downBtn = document.getElementById('down-arrow');
    downBtn.addEventListener('click', function () {
        window.scrollTo({
            top: pageHeight,
            behavior: 'smooth'
        });
    })
})}



// export default class Attraction {
//     constructor(city, name, number, rating, image, visible) {
//         this.city = city;
//         this.name = name;
//         this.number = number;
//         this.rating = rating;
//         this.image = image;
//         this.visible = false;
//     }


// }




