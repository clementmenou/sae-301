const nameZone = document.getElementById('name-zone');
const identifierZone = document.getElementById('identifier-zone');
const passwordZone = document.getElementById('password-zone');

const inputFirstName = document.getElementById('input-first-name');
const inputLastName = document.getElementById('input-last-name');
const inputUsername = document.getElementById('input-username');
const inputEmail = document.getElementById('input-email');
const inputPassword = document.getElementById('input-password');
const inputConfirmPassword = document.getElementById('input-confirm-password');

const formError = document.querySelector('.input-error-text');

const conditionLenght = document.querySelector('.input-password-condition-lenght > span');
const conditionMaj = document.querySelector('.input-password-condition-maj > span');
const conditionMin = document.querySelector('.input-password-condition-min > span');
const conditionDigit = document.querySelector('.input-password-condition-digit > span');
const conditionSpecial = document.querySelector('.input-password-condition-special > span');
const conditionMatch = document.querySelector('.input-password-condition-match > span');


if(inputFirstName.value != '' && inputLastName.value != ''){
    nameZone.style.display = 'none';
    identifierZone.style.display = 'flex';
    passwordZone.style.display = 'none';
    if (inputUsername.value != '' && inputEmail.value != '' && formError == null){
        nameZone.style.display = 'none';
        identifierZone.style.display = 'none';
        passwordZone.style.display = 'flex';
    }
} else {
    identifierZone.style.display = 'none';
    passwordZone.style.display = 'none';
}

function passwordHelper(){
    let passwordValue = inputPassword.value;
    let confirmPasswordValue = inputConfirmPassword.value;
    let isMin = /[a-z]/.test(passwordValue);
    let isMaj = /[A-Z]/.test(passwordValue);
    let isDigit = /\d/.test(passwordValue);
    let isSpecial = /[^a-zA-Z0-9]/.test(passwordValue);
    let isLenght = passwordValue.length >= 10;
    let isMatch = passwordValue == confirmPasswordValue;

    if(isMin){
        conditionMin.textContent = '✓';
        conditionMin.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionMin.textContent = '✗';
        conditionMin.style.color = '#444';
    }

    if(isMaj){
        conditionMaj.textContent = '✓';
        conditionMaj.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionMaj.textContent = '✗';
        conditionMaj.style.color = '#444';
    }

    if(isDigit){
        conditionDigit.textContent = '✓';
        conditionDigit.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionDigit.textContent = '✗';
        conditionDigit.style.color = '#444';
    }

    if(isSpecial){
        conditionSpecial.textContent = '✓';
        conditionSpecial.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionSpecial.textContent = '✗';
        conditionSpecial.style.color = '#444';
    }

    if(isLenght){
        conditionLenght.textContent = '✓';
        conditionLenght.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionLenght.textContent = '✗';
        conditionLenght.style.color = '#444';
    }

    if(isMatch){
        conditionMatch.textContent = '✓';
        conditionMatch.style.color = 'rgb(0, 160, 0)';
    } else {
        conditionMatch.textContent = '✗';
        conditionMatch.style.color = '#444';
    }
    console.log(passwordValue);
    console.log(confirmPasswordValue);
}

passwordHelper();

inputPassword.addEventListener("input", () => {
    passwordHelper();
})

inputConfirmPassword.addEventListener("input", () => {
    passwordHelper();
})