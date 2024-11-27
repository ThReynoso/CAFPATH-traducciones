<?php 
session_start();
include '../../config/connection.php';

if (!isset($_SESSION['num'])) {
    die("Unauthorized access. Please log in.");
}

$employee_num = $_SESSION['num'];

$sqlEmployee = "SELECT num, name, lastname, surname, role, warehouse FROM Employees WHERE num = ?";
$stmtEmployee = $conn->prepare($sqlEmployee);
$stmtEmployee->bind_param("i", $employee_num);
$stmtEmployee->execute();
$employee = $stmtEmployee->get_result()->fetch_assoc();
$stmtEmployee->close();

if (!$employee) {
    die("Employee not found.");
}

$sqlRoutes = "
    SELECT DISTINCT p.num AS route_id, v.number AS vehicle_id, v.license_plate, 
           p.starting_point, p.end_point, p.starting_date, p.est_arrival
    FROM RutaDetalles rd
    JOIN Vehicle v ON rd.id_vehiculo = v.number
    JOIN Path p ON rd.id_ruta = p.num
    WHERE v.number IN (
        SELECT vehicle_number 
        FROM Vehicle_Assignment 
        WHERE employee_num = ?
    )";
$stmtRoutes = $conn->prepare($sqlRoutes);
$stmtRoutes->bind_param("i", $employee_num);
$stmtRoutes->execute();
$routes = $stmtRoutes->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtRoutes->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start_route'])) {
    $route_id = $_POST['route_id'];

    $sqlUpdateStatus = "INSERT INTO Record (date, status, shipment, client, location)
                        SELECT CURDATE(), 'In Transit', s.num, s.client, NULL
                        FROM Shipment s
                        JOIN RutaDetalles rd ON rd.id_paquete = s.num
                        WHERE rd.id_ruta = ?";
    $stmtUpdateStatus = $conn->prepare($sqlUpdateStatus);
    $stmtUpdateStatus->bind_param("i", $route_id);

    if ($stmtUpdateStatus->execute()) {
        echo "Route started, and order status updated to 'In Transit'.";
    } else {
        echo "Error updating order status: " . $stmtUpdateStatus->error;
    }
    $stmtUpdateStatus->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complete_order'])) {
    $shipment_id = $_POST['shipment_id'];

    $sqlCompleteOrder = "INSERT INTO Record (date, status, shipment, client, location)
                         VALUES (CURDATE(), 'Order Delivered', ?, 
                                 (SELECT client FROM Shipment WHERE num = ?), 
                                 (SELECT CONCAT(street, ', ', colony, ' ', number) FROM Client WHERE num = (SELECT client FROM Shipment WHERE num = ?)))";
    $stmtCompleteOrder = $conn->prepare($sqlCompleteOrder);
    $stmtCompleteOrder->bind_param("iii", $shipment_id, $shipment_id, $shipment_id);

    if ($stmtCompleteOrder->execute()) {
        echo "Order marked as completed, and status updated to 'Order Delivered'.";
    } else {
        echo "Error completing order: " . $stmtCompleteOrder->error;
    }
    $stmtCompleteOrder->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finish_route'])) {
    $vehicle_id = $_POST['vehicle_id'];

    // Actualizar el estado del vehículo a 'Available'
    $sqlUpdateVehicleStatus = "UPDATE Vehicle SET status = 'available' WHERE number = ?";
    $stmtUpdateVehicleStatus = $conn->prepare($sqlUpdateVehicleStatus);
    $stmtUpdateVehicleStatus->bind_param("i", $vehicle_id);

    if ($stmtUpdateVehicleStatus->execute()) {
        echo "Vehicle status updated to 'Available'.";
    } else {
        echo "Error updating vehicle status: " . $stmtUpdateVehicleStatus->error;
    }
    $stmtUpdateVehicleStatus->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Routes and Assigned Orders for Driver</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($employee['name'] . ' ' . $employee['lastname'] . ' ' . $employee['surname']); ?></h2>
    <p>Employee ID: <?php echo htmlspecialchars($employee['num']); ?></p>
    <p>Role: <?php echo htmlspecialchars($employee['role']); ?></p>
    <p>Warehouse: <?php echo htmlspecialchars($employee['warehouse']); ?></p>

    <h2>Assigned Routes</h2>

    <?php if (count($routes) > 0): ?>
        <?php foreach ($routes as $route): ?>
            <div>
                <h3>Route ID: <?php echo htmlspecialchars($route['route_id']); ?> - Vehicle: <?php echo htmlspecialchars($route['license_plate']); ?></h3>
                <p>Starting Point: <?php echo htmlspecialchars($route['starting_point']); ?> - Destination: <?php echo htmlspecialchars($route['end_point']); ?></p>
                <p>Starting Date: <?php echo htmlspecialchars($route['starting_date']); ?> - Estimated Arrival: <?php echo htmlspecialchars($route['est_arrival']); ?></p>
                
                <form method="POST">
                    <input type="hidden" name="route_id" value="<?php echo htmlspecialchars($route['route_id']); ?>">
                    <button type="submit" name="start_route">Start Route</button>
                </form>

                <form method="POST">
                    <input type="hidden" name="vehicle_id" value="<?php echo htmlspecialchars($route['vehicle_id']); ?>">
                    <button type="submit" name="finish_route">Finish Route</button>
                </form>

                <h4>Orders Assigned to this Route</h4>
                <ul>
                    <?php
                    $sqlOrders = "SELECT s.num AS shipment_id, c.name AS client_name, c.street, c.colony, c.number
                                  FROM Shipment s
                                  JOIN RutaDetalles rd ON rd.id_paquete = s.num
                                  JOIN Client c ON c.num = s.client
                                  WHERE rd.id_ruta = ?";
                    $stmtOrders = $conn->prepare($sqlOrders);
                    $stmtOrders->bind_param("i", $route['route_id']);
                    $stmtOrders->execute();
                    $orders = $stmtOrders->get_result()->fetch_all(MYSQLI_ASSOC);
                    $stmtOrders->close();

                    if (count($orders) > 0) {
                        foreach ($orders as $order): ?>
                            <li>
                                Order ID: <?php echo htmlspecialchars($order['shipment_id']); ?> - Client: <?php echo htmlspecialchars($order['client_name']); ?>
                                - Address: <?php echo htmlspecialchars($order['street'] . ", " . $order['colony'] . " " . $order['number']); ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="shipment_id" value="<?php echo htmlspecialchars($order['shipment_id']); ?>">
                                    <button type="submit" name="complete_order">Mark as Completed</button>
                                </form>
                            </li>
                        <?php endforeach;
                    } else {
                        echo "<li>No orders assigned to this route.</li>";
                    }
                    ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no assigned routes.</p>
    <?php endif; ?>
</body>
</html>



