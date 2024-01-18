const formAddressChoice = document.querySelector('.form-choice-address');
const formAdd = document.querySelector('.form-add-address');
const formModif = document.querySelectorAll('.form-modif-address');

const buttonAddress = document.querySelectorAll('.button-adress-choice');
const buttonAddAddress = document.querySelector('.address-add');
const buttonGoBack = document.querySelectorAll('.form-go-back');

formAdd.style.display = 'none';
formModif.forEach(elem => {
    elem.style.display = 'none';
});

buttonAddress.forEach(button => {
    button.addEventListener('click', () => {
        let addressId = button.dataset.addressId;
        formModif.forEach(form => {
            form.style.display = 'none';
            if(form.classList.contains('form-modif-address' + addressId)){
                form.style.display = 'flex';
                formAddressChoice.style.display = 'none';
            }
        });
    });
});

buttonGoBack.forEach(button => {
    button.addEventListener('click', () => {
        formModif.forEach(form => {
            form.style.display = 'none';
        });
        formAdd.style.display = 'none';
        formAddressChoice.style.display = 'flex';
    });
});

buttonAddAddress.addEventListener('click', () => {
    formModif.forEach(form => {
        form.style.display = 'none';
    });
    formAdd.style.display = 'flex';
    formAddressChoice.style.display = 'none';
});