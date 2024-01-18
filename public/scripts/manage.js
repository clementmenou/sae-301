// Gestion du formulaire pour ajouter un parfum
var imageInput = document.getElementById('insert_image');
var imagePreview = document.getElementById('preview-image');

imageInput.style.display = "none";

imageInput.addEventListener('change', function(event) {
    var fichierImage = event.target.files[0];
    if (fichierImage) {
        var reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        };
        reader.readAsDataURL(fichierImage);
    }
});


// Gestion du formulaire pour mettre à jour les quantités
const quantityContainer = document.querySelector('.all-quantity');
const allQuantity = document.querySelectorAll('.all-quantity > div');
const selectNameUpdateQuantity = document.querySelector('#update_name');
const inputQuantity = document.querySelector('#update_quantity');

quantityContainer.style.display = "none";

var tableQuantity = [];

allQuantity.forEach(elem => {
    tableQuantity.push(elem.textContent);
})

inputQuantity.value = (tableQuantity[0] !== null && tableQuantity[0] !== undefined) ? tableQuantity[0] : '';

selectNameUpdateQuantity.addEventListener('change', (elem) => {
    quantityIndex = elem.target.selectedIndex;
    inputQuantity.value = tableQuantity[quantityIndex];
});



// Gestion d'insertion d'une promotion
const inputStartDay = document.getElementById('insert_promo_start_day');
const inputStartMonth = document.getElementById('insert_promo_start_month');
const inputStartYear = document.getElementById('insert_promo_start_year');

const inputEndDay = document.getElementById('insert_promo_end_day');
const inputEndMonth = document.getElementById('insert_promo_end_month');
const inputEndYear = document.getElementById('insert_promo_end_year');

function passerAuChampSuivant(champActuel, champSuivant) {
    var longueurMax = parseInt(champActuel.getAttribute('maxlength'));
    var contenuChamp = champActuel.value;

    if (contenuChamp.length === longueurMax) {
        if (champSuivant) {
            champSuivant.focus();
        }
    }
}

inputStartDay.addEventListener('input', function() {
    passerAuChampSuivant(this, inputStartMonth);
})

inputStartMonth.addEventListener('input', function() {
    passerAuChampSuivant(this, inputStartYear);
})

inputStartYear.addEventListener('input', function() {
    passerAuChampSuivant(this, inputEndDay);
})

inputEndDay.addEventListener('input', function() {
    passerAuChampSuivant(this, inputEndMonth);
})

inputEndMonth.addEventListener('input', function() {
    passerAuChampSuivant(this, inputEndYear);
})