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
    <title>Carrito de Compras</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
    <section id="carrito">
    <h2>Carrito de Compras</h2>
    <div id="cart-items" class="cart-items-container"></div>
    <div id="total-container">
        <strong>Total: </strong><span id="total-price">$0.00</span>
    </div>
    <button id="clear-cart">Vaciar Carrito</button>
    </section>
    <section id="comprar">
        <h2>Completá tu compra</h2>
        <form id="purchase-form" action="process_purchase.php" method="POST">
            <div>
                <label for="payment">Medio de pago:</label>
                <select id="payment" name="payment" required>
                    <option value="tarjeta">Tarjeta de Crédito</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                    <option value="efectivo">Efectivo</option>
                </select>
            </div>
            <div>
                <label for="product-list">Listado de productos:</label>
                <textarea id="product-list" name="product-list" readonly></textarea>
            </div>
            <button type="submit">Realizar Compra</button>
        </form>
        <div id="message"></div>
    </section>
</main>
    <footer>
        <p>&copy; 2024 Elite Suplementos</p>
    </footer>

    <script src="cart.js"></script>
