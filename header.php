<header>
    <nav>
        <!-- Logo alineado a la izquierda -->
        <div class="brand">
            <a href="index.php">
                <span class="elite">ELITE</span>
                <span class="suplementos">Suplementos</span>
            </a>
        </div>

        <!-- Contenedor para los enlaces alineados a la derecha -->
        <ul class="nav-links">
            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="navegacion/registro.html">Crear Cuenta</a></li>
                <li><a href="navegacion/sesion.html">Iniciar Sesión</a></li>
            <?php endif; ?>
            <li>
                <a href="carrito.php" class="carrito-link">
                    <img src="imagenes/carrito.png" alt="Carrito" class="icono-carrito">
                </a>
            </li>
        </ul>
    </nav>
</header>
