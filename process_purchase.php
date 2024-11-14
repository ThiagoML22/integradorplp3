<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Por favor, inicia sesión para realizar la compra.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo_pago = $_POST['payment'] ?? '';
    $productos = $_POST['product-list'] ?? '';

    if (empty($metodo_pago) || empty($productos)) {
        echo json_encode(['status' => 'error', 'message' => 'Error: Completa todos los campos.']);
        exit;
    }

    try {
        $conn->beginTransaction();
        $user_id = $_SESSION['user_id'];
        $queryCompra = "INSERT INTO compras (cliente_id, metodo_pago) VALUES (:cliente_id, :metodo_pago)";
        $stmtCompra = $conn->prepare($queryCompra);
        $stmtCompra->execute(['cliente_id' => $user_id, 'metodo_pago' => $metodo_pago]);

        $compra_id = $conn->lastInsertId();
        if (!$compra_id) {
            throw new Exception("Error al registrar la compra.");
        }

        $productos_array = explode("\n", trim($productos));
        foreach ($productos_array as $producto) {
            if (empty($producto)) continue;

            list($producto_nombre, $producto_precio) = explode(",", trim($producto));
            $queryProducto = "SELECT id, stock FROM productos WHERE nombre = :nombre";
            $stmtProducto = $conn->prepare($queryProducto);
            $stmtProducto->execute(['nombre' => $producto_nombre]);
            $producto_data = $stmtProducto->fetch(PDO::FETCH_ASSOC);

            if ($producto_data) {
                $producto_id = $producto_data['id'];
                $stock_actual = $producto_data['stock'];

                if ($stock_actual <= 0) {
                    throw new Exception("El producto '$producto_nombre' está fuera de stock.");
                }

                $queryDetalle = "INSERT INTO detalles_compra (compra_id, producto_id, cantidad) VALUES (:compra_id, :producto_id, 1)";
                $stmtDetalle = $conn->prepare($queryDetalle);
                $stmtDetalle->execute(['compra_id' => $compra_id, 'producto_id' => $producto_id]);

                $queryActualizarStock = "UPDATE productos SET stock = stock - 1 WHERE id = :producto_id";
                $stmtActualizarStock = $conn->prepare($queryActualizarStock);
                $stmtActualizarStock->execute(['producto_id' => $producto_id]);
            } else {
                throw new Exception("El producto '$producto_nombre' no existe en la base de datos.");
            }
        }

        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Compra realizada con éxito.']);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(['status' => 'error', 'message' => "Error al procesar la compra: " . $e->getMessage()]);
    }
}
