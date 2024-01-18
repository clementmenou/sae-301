const inputCardNumber = document.getElementById('input-card-number');
const inputExpirationMonth = document.getElementById('input-expiration-month');
const inputExpirationYear = document.getElementById('input-expiration-year');
const inputCodeSecurite = document.getElementById('input-security-code');
const inputName = document.getElementById('input-name');

function passerAuChampSuivant(champActuel, champSuivant) {
    var longueurMax = parseInt(champActuel.getAttribute('maxlength'));
    var contenuChamp = champActuel.value;

    if (contenuChamp.length === longueurMax) {
        if (champSuivant) {
            champSuivant.focus();
        }
    }
}

function ajouterEspaces(champ) {
    var contenuSansEspaces = champ.value.replace(/\s/g, '');

    var contenuAvecEspaces = contenuSansEspaces.replace(/(.{4})/g, '$1 ');

    champ.value = contenuAvecEspaces.trim();
  }

inputCardNumber.addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');
    ajouterEspaces(this);
    passerAuChampSuivant(this, inputExpirationMonth);
})

inputExpirationMonth.addEventListener('input', function() {
    passerAuChampSuivant(this, inputExpirationYear);
})

inputExpirationYear.addEventListener('input', function() {
    passerAuChampSuivant(this, inputCodeSecurite);
})

inputCodeSecurite.addEventListener('input', function() {
    passerAuChampSuivant(this, inputName);
})