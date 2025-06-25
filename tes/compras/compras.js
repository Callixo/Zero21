document.addEventListener('DOMContentLoaded', () => {
    loadCartItems();
  });
  
  function loadCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    let totalPrice = 0;
  
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    cartItemsContainer.innerHTML = '';
  
    cartItems.forEach(item => {
      const itemElement = document.createElement('div');
      itemElement.classList.add('produto');
  
      itemElement.innerHTML = `
        <div class="produto-img">
          <img src="${item.image}" alt="${item.name}">
        </div>
        <div class="product-details">
          <h2>${item.name}</h2>
          <p class="product-price">R$ ${item.price}</p>
        </div>
      `;
  
      cartItemsContainer.appendChild(itemElement);
      totalPrice += item.price;
    });
  
    totalPriceElement.textContent = totalPrice.toFixed(2);
  }
  
  document.getElementById('checkout-form').addEventListener('submit', function (e) {
    e.preventDefault();
  
    const formData = new FormData(this);
  
    // Simulação de processamento de pagamento
    alert('Compra realizada com sucesso!');
    localStorage.removeItem('cart');
    window.location.href = '../index.php';
  });
  