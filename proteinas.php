<?php
session_start();
include 'db.php';

// Consultar productos de la categoría 'proteinas'
$stmt = $conn->prepare("SELECT * FROM productos WHERE categoria = 'proteina' AND activo = 1 ORDER BY fecha_agregado DESC");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Elite Suplementos - Proteínas</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section id="productos_box">
            <center><h2>Proteínas</h2></center>
            <div class="products-container">
                <?php foreach ($productos as $producto): ?>
                    <div class="product-box">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <h3><?php echo $producto['nombre']; ?></h3>
                        <p class="price">$<?php echo number_format($producto['precio'], 2, ',', '.'); ?></p>
                        <p>Stock: <?php echo $producto['stock']; ?> unidades</p>
                        <button class="add-to-cart-btn"
                                data-name="<?php echo addslashes($producto['nombre']); ?>"
                                data-price="<?php echo number_format($producto['precio'], 2, ',', '.'); ?>"
                                data-img="<?php echo addslashes($producto['imagen']); ?>">
                            Agregar al Carrito
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="carrito">
            <h2>Carrito de Compras</h2>
            <div id="cart-items"></div>
            <textarea id="product-list" readonly></textarea>
            <p>Total: <span id="total-price">$0.00</span></p>
            <button id="clear-cart">Vaciar Carrito</button>

            <form id="purchase-form">
            </form>
            <div id="message"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Elite Suplementos</p>
    </footer>

    <script src="cart.js"></script>

    </main>

    <footer>
        <p>&copy; 2024 Elite Suplementos</p>
    </footer>
</body>
</html>
