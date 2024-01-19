// Gestion des input de quantité 
const inputQuantity = document.getElementById('input-quantity');
const inputModify = document.querySelector('.button-modifier');

const buttonQuantity1 = document.getElementById('button-quantity1');
const buttonQuantity2 = document.getElementById('button-quantity2');


buttonQuantity1.addEventListener('click', () => {
    inputQuantity.value -= 1;
    inputModify.click();
})

buttonQuantity2.addEventListener('click', () => {
    inputQuantity.value = parseInt(inputQuantity.value) + 1;
    inputModify.click();
})
