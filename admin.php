<?php
session_start();
include 'db.php';

// Procesar la adición de un nuevo producto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];  // Cambié 'titulo' por 'nombre'
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $imagen = $_FILES['imagen']['name'];
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $ruta_imagen = "imagenes/" . $imagen;

    // Validar campos obligatorios
    if ($nombre && $precio && $stock && $categoria && $imagen) {
        // Mover la imagen cargada a la carpeta 'imagenes/'
        move_uploaded_file($imagen_tmp, $ruta_imagen);
        
        // Insertar producto en la base de datos
        $sql = "INSERT INTO productos (nombre, precio, stock, categoria, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio, $stock, $categoria, $ruta_imagen]);
        
        $mensaje = "Producto agregado correctamente.";
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

// Obtener todos los productos
$stmt = $conn->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Panel de Administración</h2>
    
    <!-- Mensaje de éxito o error -->
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
    
    <!-- Formulario para agregar productos -->
    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>

        <label for="categoria">Categoría:</label>
        <select name="categoria" required>
            <option value="proteina">Proteína</option>
            <option value="creatina">Creatina</option>
            <option value="pre">Pre-Workout</option>
        </select>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/*" required>

        <button type="submit">Agregar Producto</button>
    </form>

    <!-- Lista de productos -->
    <h3>Lista de Productos</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Imagen</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?= $producto['id'] ?></td>
            <td><?= $producto['nombre'] ?></td>
            <td>$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
            <td><?= $producto['stock'] ?></td>
            <td><?= $producto['categoria'] ?></td>
            <td><img src="<?= $producto['imagen'] ?>" width="50"></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

<style> 

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    color: #333;
    padding: 20px;
}

/* Encabezado del panel */
h2 {
    text-align: center;
    font-size: 2em;
    color:#ff7b00;;
    margin-bottom: 20px;
}

/* Mensajes de éxito/error */
p {
    font-size: 1.1em;
    text-align: center;
    padding: 10px;
    margin: 20px 0;
    border-radius: 5px;
    background-color: #e7f7e7;
    color: #388e3c;
}

p.error {
    background-color: #fddede;
    color: #f44336;
}

/* Estilo del formulario */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    max-width: 500px;
    margin: 0 auto;
}

/* Etiquetas y campos del formulario */
form label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #444;
}

form input, form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1em;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease;
}

form input:focus, form select:focus {
    border-color: #ff7b00;
    outline: none;
}

form button {
    background-color: #ff7b00;
    color: white;
    font-size: 1.1em;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #ff7b00;
}

/* Tabla de productos */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #ff7b00;;
    color: white;
    font-weight: bold;
}

table td img {
    width: 60px;
    border-radius: 5px;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

/* Respuesta visual para el formulario de imagen */
form input[type="file"] {
    padding: 5px;
}

 </style>

</html>
