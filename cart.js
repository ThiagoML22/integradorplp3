document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const productListTextarea = document.getElementById('product-list');
    const clearCartButton = document.getElementById('clear-cart');
    const purchaseForm = document.getElementById('purchase-form');
    const messageDiv = document.getElementById('message');
    const totalPriceElement = document.getElementById('total-price');

    function parsePrice(price) {
        const cleanedPrice = price.replace('$', '').replace(/\./g, '').replace(',', '.');
        return parseFloat(cleanedPrice);
    }

    function addToCart(product) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const productExists = cart.find(item => item.name === product.name);

        if (!productExists) {
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateProductList();
            alert('Producto añadido al carrito');
        } else {
            alert('Este producto ya está en el carrito');
        }
    }

    function updateProductList() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItemsContainer.innerHTML = '';
        let productLines = '';
        let totalPrice = 0;

        cart.forEach(item => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('cart-item');

            const productImage = document.createElement('img');
            productImage.src = item.img;
            productDiv.appendChild(productImage);

            const productName = document.createElement('div');
            productName.classList.add('name');
            productName.textContent = item.name;
            productDiv.appendChild(productName);

            const productPrice = document.createElement('div');
            productPrice.classList.add('price');
            productPrice.textContent = item.price;
            productDiv.appendChild(productPrice);

            cartItemsContainer.appendChild(productDiv);

            productLines += `${item.name}, ${item.price}\n`;

            const priceValue = parsePrice(item.price);
            if (!isNaN(priceValue)) {
                totalPrice += priceValue;
            }
        });

        productListTextarea.value = productLines;
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    }

    clearCartButton.addEventListener('click', () => {
        localStorage.removeItem('cart');
        updateProductList();
    });

    purchaseForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(purchaseForm);
        formData.append('product-list', productListTextarea.value);

        fetch('process_purchase.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.textContent = data.message;
            messageDiv.className = data.status === 'success' ? 'success' : 'error';

            if (data.status === 'success') {
                localStorage.removeItem('cart');
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 3000);
            }
        })
        .catch(error => {
            messageDiv.textContent = 'Ocurrió un error al procesar la compra.';
            messageDiv.className = 'error';
        });
    });

    updateProductList();

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const product = {
                name: button.getAttribute('data-name'),
                price: button.getAttribute('data-price'),
                img: button.getAttribute('data-img')
            };
            addToCart(product);
        });
    });
});
