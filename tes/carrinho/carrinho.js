document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
  
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function () {
        const productElement = this.closest('.produto');
        const productId = productElement.getAttribute('data-id');
        const productName = productElement.querySelector('.product-details h1').innerText;
        const productPrice = productElement.querySelector('.product-price span').innerText.replace('$', '');
      });
    });
  });
  