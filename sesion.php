<?php
// Iniciar la sesión
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($email) || empty($password)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Consulta a la base de datos para verificar el email
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if ($user && password_verify($password, $user['password'])) {
            // Iniciar sesión y guardar los datos en $_SESSION
            $_SESSION['usuario'] = $user['nombre']; // O cambiar por $user['email'] según tu preferencia
            $_SESSION['user_id'] = $user['id'];

            // Redirigir al usuario al index.php
            header('Location: index.php');
            exit();
        } else {
            $error = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    }
}
