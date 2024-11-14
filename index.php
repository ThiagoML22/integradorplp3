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
    <title>Elite Suplementos</title>
</head>
<body>
    <!-- Incluye el header aquí -->
    <?php include 'header.php'; ?>

    <main>
            <section id="bienvenida" class="carousel">
                <div class="carousel-container">
                    <img src="imagenes/flyer.jpg" alt="Imagen 1">
                    <img src="imagenes/suple.jpg" alt="Imagen 2">
                    <img src="imagenes/suples.jpg" alt="Imagen 3">
                </div>
            </section>

            <section id="categorias">
                <center><h2>CATEGORÍAS</h2></center>
                <div class="categories-container">
                    <div class="category-box">
                        <a href="creatinas.php">
                            <img src="imagenes/crea.jpg" alt="Creatinas">
                            <h3>CREATINAS</h3>
                        </a>
                    </div>
                    <div class="category-box">
                        <a href="proteinas.php">
                            <img src="imagenes/whey.jpg" alt="Proteínas">
                            <h3>PROTEÍNAS</h3>
                        </a>
                    </div>
                    <div class="category-box">
                        <a href="pre.php">
                            <img src="imagenes/pre.jpg" alt="Pre Workout">
                            <h3>PRE WORKOUT</h3>
                        </a>
                    </div>
                </div>

            <section id="productos_box">
                <center><h2>PRODUCTOS DESTACADOS</h2></center>
                <div class="products-container">
                    <div class="product-box">
                        <a href="ena.php">
                            <img src="imagenes/whey.jpg" alt="Producto 1">
                            <h3>Proteina ENA</h3>
                            <p class="price">$34.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="creaena.php">
                            <img src="imagenes/crea.jpg" alt="Producto 1">
                            <h3>Creatina ENA</h3></p>
                            <p class="price">$32.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="pregs.php">
                            <img src="imagenes/pre.jpg" alt="Producto 1">
                            <h3>Pre-Workout</h3>
                            <p class="price">$25.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="omega.php">
                            <img src="imagenes/omega.jpg" alt="Producto 1">
                            <h3>Omega 3</h3>
                            <p class="price">$46.600,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="creaon.php">
                            <img src="imagenes/creaon.jpg" alt="Producto 1">
                            <h3>Creatina Optimun Nutrition</h3>
                            <p class="price">$55.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="massena.php">
                            <img src="imagenes/mass.jpg" alt="Producto 1">
                            <h3>Ganador de peso ENA</h3>
                            <p class="price">$29.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="creastar.php">
                            <img src="imagenes/creastar.jpg" alt="Producto 1">
                            <h3>Creatina STAR</h3>
                            <p class="price">$28.999,00</p>
                        </a>
                    </div>
                    <div class="product-box">
                        <a href="optimun.php">
                            <img src="imagenes/wheyy.jpg" alt="Producto 1">
                            <h3>Proteina Optimun Nutrition</h3>
                            <p class="price">$103.999,00</p>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <style>
    .icono-usuario {
        width: 50x;
        height: 30px;
        border-radius: 50%;
    }
    #user-icon {
    margin-right: 20px; /* Espacio extra entre icono de usuario y otros elementos */
}

</style>

    <footer>
        <p>&copy; 2024 Elite Suplementos</p>
    </footer>
    <script src="carousel.js"></script>
</body>
</html>
