<?php
session_start();
include '../../config/connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['num'])) {
    die("Unauthorized access. Please log in.");
}

$supervisor_id = $_SESSION['supervisor_id'] ?? 1; 

$query_warehouse = "SELECT warehouse FROM Employees WHERE num = ?";
$stmt_warehouse = $conn->prepare($query_warehouse);
$stmt_warehouse->bind_param("i", $supervisor_id);
$stmt_warehouse->execute();
$result_warehouse = $stmt_warehouse->get_result();

if ($result_warehouse->num_rows > 0) {
    $row = $result_warehouse->fetch_assoc();
    $warehouse_code = $row['warehouse'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item_code = $_POST['item_code'];
        $item_name = $_POST['item_name'];
        $item_description = $_POST['item_description'];
        $item_amount = $_POST['item_amount'];

        if (!empty($item_code) && !empty($item_name) && !empty($item_amount)) {
            // Iniciar transacción
            $conn->begin_transaction();

            try {
                $query_item = "INSERT INTO Item (code, name, description) VALUES (?, ?, ?)";
                $stmt_item = $conn->prepare($query_item);
                $stmt_item->bind_param("sss", $item_code, $item_name, $item_description);
                $stmt_item->execute();

                $query_stock = "INSERT INTO Stock (code, name, amount, warehouse) VALUES (?, ?, ?, ?)";
                $stmt_stock = $conn->prepare($query_stock);
                $stmt_stock->bind_param("ssis", $item_code, $item_name, $item_amount, $warehouse_code);
                $stmt_stock->execute();

                $query_inventory = "INSERT INTO Inventory (stock, item) VALUES (?, ?)";
                $stmt_inventory = $conn->prepare($query_inventory);
                $stmt_inventory->bind_param("ss", $item_code, $item_code);
                $stmt_inventory->execute();

                $conn->commit();

                echo "El artículo se agregó exitosamente al almacén del supervisor.";
            } catch (Exception $e) {
                $conn->rollback();
                echo "Error al agregar el artículo: " . $e->getMessage();
            }
        } else {
            echo "Todos los campos son obligatorios.";
        }
    }
} else {
    echo "No se pudo determinar el almacén del supervisor.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Artículo</title>
</head>
<body>
    <h1>Agregar Nuevo Artículo</h1>
    <form method="post" action="">
        <label for="item_code">Código del Artículo:</label><br>
        <input type="text" id="item_code" name="item_code" required><br><br>

        <label for="item_name">Nombre del Artículo:</label><br>
        <input type="text" id="item_name" name="item_name" required><br><br>

        <label for="item_description">Descripción del Artículo:</label><br>
        <textarea id="item_description" name="item_description"></textarea><br><br>

        <label for="item_amount">Cantidad:</label><br>
        <input type="number" id="item_amount" name="item_amount" required><br><br>

        <input type="submit" value="Agregar Artículo">
    </form>
</body>
</html>
