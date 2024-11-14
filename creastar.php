<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Ganador de peso ENA</title>
</head>
<body>
     <!-- Incluye el header aquí -->
     <?php include 'header.php'; ?>
    <!-- Apertura del main -->
    <main>
        <section class="product-detail">
            <h2>Creatina STAR</h2>
            <div class="product-image">
                <img src="imagenes/creastar.jpg" alt="Creatina STAR">
            </div>
            <div class="product-info">
                <p>Precio: $32.999,00</p>
                <button id="add-to-cart">Añadir al Carrito</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Elite Suplementos</p>
    </footer>

    <script>
        // Añadir producto al carrito
        document.getElementById('add-to-cart').addEventListener('click', function() {
            const product = {
                name: 'Creatina STAR',
                price: '$32.999,00',
                img: 'imagenes/creastar.jpg'
            };

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));

            alert('Producto añadido al carrito');
        });
    </script>
</body>
</html>
