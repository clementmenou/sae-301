// Gestion des input de quantité 
const inputQuantity = document.getElementById('input-quantity');

const buttonQuantity1 = document.getElementById('button-quantity1');
const buttonQuantity2 = document.getElementById('button-quantity2');

buttonQuantity1.addEventListener('click', () => {
    inputQuantity.value -= 1;
})

buttonQuantity2.addEventListener('click', () => {
    inputQuantity.value = parseInt(inputQuantity.value) + 1;
})



// Gestion des étoiles en commentaires
const inputRatingInsert = document.querySelectorAll('.input-rating-insert');
const inputRatingUpdate = document.querySelectorAll('.input-rating-update');
const starsInsert = document.querySelectorAll('.comment-star-insert');
const starsUpdate = document.querySelectorAll('.comment-star-update');

animateStars(inputRatingInsert, starsInsert);
animateStars(inputRatingUpdate, starsUpdate);

inputRatingInsert.forEach( elem => {
    elem.addEventListener('change', () => {
        animateStars(inputRatingInsert, starsInsert);
    });
});

inputRatingUpdate.forEach( elem => {
    elem.addEventListener('change', () => {
        animateStars(inputRatingUpdate, starsUpdate);
    });
});

function animateStars(radio, star){
    for(let j = 0; j < 5; j++){
        let i = j + 1;
        if(radio[j].checked) {
            star.forEach(element => {
                if (i > 0) element.style.filter = "grayscale(0)";
                else element.style.filter = "grayscale(1)";
                i--;
            });
        }
    }
}