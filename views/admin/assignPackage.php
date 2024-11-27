<?php
session_start();
include '../../config/connection.php';

if (!isset($_SESSION['num'])) {
    die("Acceso no autorizado. Por favor inicie sesión.");
}

$employee_id = $_SESSION['num'];

$sqlOrders = "SELECT sh.num AS shipment_id, sh.date, sh.delivery_date, 
                     c.name AS client_name, c.lastname AS client_lastname, 
                     c.street, c.colony, c.number AS client_number, 
                     v.license_plate, v.model, 
                     p.starting_point, p.end_point, p.starting_date, p.est_arrival
              FROM Shipment sh
              JOIN Assamble a ON a.shipment = sh.num
              JOIN Client c ON c.num = sh.client
              LEFT JOIN Vehicle v ON sh.vehicle = v.number
              LEFT JOIN Path p ON sh.path = p.num
              WHERE a.employees = ?";
$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->bind_param("i", $employee_id);
$stmtOrders->execute();
$orders = $stmtOrders->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtOrders->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos Asignados</title>
</head>
<body>
    <h2>Pedidos Asignados</h2>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <div>
                <h3>Pedido ID: <?php echo $order['shipment_id']; ?></h3>
                <p><strong>Fecha de Pedido:</strong> <?php echo $order['date']; ?></p>
                <p><strong>Fecha de Entrega:</strong> <?php echo $order['delivery_date']; ?></p>
                
                <h4>Detalles del Cliente</h4>
                <p><strong>Nombre:</strong> <?php echo $order['client_name'] . ' ' . $order['client_lastname']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $order['street'] . ', ' . $order['colony'] . ' ' . $order['client_number']; ?></p>
                
                <h4>Detalles del Vehículo</h4>
                <p><strong>Placa:</strong> <?php echo $order['license_plate']; ?></p>
                <p><strong>Modelo:</strong> <?php echo $order['model']; ?></p>

                <h4>Detalles de la Ruta</h4>
                <p><strong>Punto de Inicio:</strong> <?php echo $order['starting_point']; ?></p>
                <p><strong>Punto de Destino:</strong> <?php echo $order['end_point']; ?></p>
                <p><strong>Fecha de Inicio:</strong> <?php echo $order['starting_date']; ?></p>
                <p><strong>Fecha Estimada de Llegada:</strong> <?php echo $order['est_arrival']; ?></p>

                <h4>Contenido del Pedido</h4>
                <?php
                $shipment_id = $order['shipment_id'];
                include '../../config/connection.php';
                $sqlItems = "SELECT it.name AS item_name, it.description
                             FROM Package p
                             JOIN Item it ON p.item = it.code
                             WHERE p.shipment = ?";
                $stmtItems = $conn->prepare($sqlItems);
                $stmtItems->bind_param("i", $shipment_id);
                $stmtItems->execute();
                $items = $stmtItems->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmtItems->close();
                ?>
                <ul>
                    <?php foreach ($items as $item): ?>
                        <li><?php echo $item['item_name'] . ': ' . $item['description']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes pedidos asignados.</p>
    <?php endif; ?>
</body>
</html>
