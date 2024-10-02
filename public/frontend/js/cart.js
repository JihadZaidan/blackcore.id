function changeQuantity(button, change) {
    const container = button.closest('.d-flex');
    const input = container.querySelector('.quantity-input');
    const priceElement = container.querySelector('.item-price');
    
    let value = parseInt(input.value) + change;
    value = Math.max(1, value); // Ensure minimum value is 1
    input.value = value;
    
    updateItemPrice(input, priceElement);
    updateTotalPrice();
  }
  
  function updateItemPrice(input, priceElement) {
    const quantity = parseInt(input.value);
    const unitPrice = 1156.00; // You should get this dynamically for each item
    const totalItemPrice = quantity * unitPrice;
    priceElement.textContent = '$' + totalItemPrice.toFixed(2);
  }
  
  function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll('.item-price').forEach(item => {
      total += parseFloat(item.textContent.replace('$', ''));
    });
    document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
  }
  
  function removeItem(button) {
    button.closest('.cart-item').remove();
    updateTotalPrice();
  }
  
  // Initialize total price on page load
  document.addEventListener('DOMContentLoaded', updateTotalPrice);