<?php
// registro.php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $telefono = $_POST['phone'];

    $query = "INSERT INTO usuarios (nombre, email, password, telefono) VALUES (:nombre, :email, :password, :telefono)";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute(['nombre' => $nombre, 'email' => $email, 'password' => $password, 'telefono' => $telefono]);
        // Redireccionar después de un registro exitoso
        header('Location: navegacion/sesion.html');
        exit(); // Importante para asegurar que no se ejecute más código después del header
    } catch (PDOException $e) {
        echo "Error en el registro: " . $e->getMessage();
    }
}