function addToCart(name, price) {
    sessionStorage.setItem('plan-name', name);
    sessionStorage.setItem('plan-price', price);

    window.location.href = "checkout";
}
