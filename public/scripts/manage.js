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