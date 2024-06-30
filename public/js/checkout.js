function checkSameAddress() {
    const checkBox = document.getElementById('same-address');
    const shippingAddressDiv = document.getElementById('shipping-address-div');
    checkBox.addEventListener('change', () => {
        if (checkBox.checked) {
            shippingAddressDiv.style.display = 'none';
        } else {
            shippingAddressDiv.style.display = 'block';
        }
    })
}

window.onload = checkSameAddress;

document.addEventListener('DOMContentLoaded', function() {
    const name = sessionStorage.getItem('plan-name');
    const price = sessionStorage.getItem('plan-price');

    const planName = document.getElementById('plan-name');
    const planPrice = document.getElementById('plan-price');
    const totalPrice = document.getElementById('total-price');


    planName.textContent = name;
    planPrice.textContent = "€" + price;
    totalPrice.textContent = "€" + price;

    sessionStorage.removeItem('plan-name');
    sessionStorage.removeItem('plan-price');
})

window.addEventListener('load', () => {
    initRedeemCodeFormSubmit();
})

function initRedeemCodeFormSubmit() {
    const form = document.querySelector('#redeemCodeModal form')
    form.addEventListener('submit', event => {
        event.preventDefault();
        sendData(form);
    })
}

function sendData(form) {
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);

    xhr.addEventListener('load', () => {
        const response = JSON.parse(xhr.responseText);
        document.getElementById('promo-code').textContent = response.redeemCode;
        if (response.redeemValue) {
            setRedeemValue(response.redeemValue);
            setCartPrice(response.redeemValue);
        }
    })

    xhr.open('POST', form.getAttribute('action'));
    xhr.send(formData);
}

function setCartPrice(value) {
    const totalPrice = document.getElementById('total-price');
    let price = parseInt(totalPrice.textContent.replace(/[^\d.-]/g, ''), 10);
    price = price * (100 - parseInt(value, 10)) / 100;
    totalPrice.textContent = "€" + price;
}

function setRedeemValue(value) {
    document.getElementById('promo-value').textContent = value + "%";
}