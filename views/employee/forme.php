<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'R002') {
    header("Location: login.php");
    exit();
}

include '../../config/connection.php';

$employeeNum = $_SESSION['num'];

// Obtener los detalles del empleado
$sqlEmpleado = "SELECT name, lastname, surname FROM Employees WHERE num = ?";
$stmtEmpleado = $conn->prepare($sqlEmpleado);
$stmtEmpleado->bind_param("i", $employeeNum);
$stmtEmpleado->execute();
$stmtEmpleado->bind_result($employeeName, $employeeLastname, $employeeSurname);
$stmtEmpleado->fetch();
$stmtEmpleado->close();

if (!$employeeName) {
    die("Error: No se pudo obtener los detalles del empleado.");
}

// Cambiar estado a "Finished" si se envió un formulario de completado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipment_id'])) {
    $shipmentId = $_POST['shipment_id'];

    $sqlUpdateStatus = "UPDATE Assamble SET status = 'Finished' WHERE shipment = ?";
    $stmtUpdate = $conn->prepare($sqlUpdateStatus);
    $stmtUpdate->bind_param("i", $shipmentId);
    $stmtUpdate->execute();
    $stmtUpdate->close();
}

// Obtener pedidos asignados al empleado junto con detalles del cliente y contenido del paquete
$sql = "SELECT s.num AS shipment_id, s.date AS shipment_date, s.delivery_date, c.name AS client_name, a.status
        FROM Assamble a
        JOIN Shipment s ON a.shipment = s.num
        JOIN Client c ON s.client = c.num
        WHERE a.employees = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employeeNum);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Asignados</title>
</head>
<body>
    <h1>Pedidos Asignados a <?php echo htmlspecialchars($employeeName . ' ' . $employeeLastname . ' ' . $employeeSurname); ?></h1>
    <p>Estos son los pedidos que tienes asignados:</p>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #000;">
                <p><strong>ID Pedido:</strong> <?php echo htmlspecialchars($row['shipment_id']); ?></p>
                <p><strong>Fecha de Pedido:</strong> <?php echo htmlspecialchars($row['shipment_date']); ?></p>
                <p><strong>Fecha de Entrega:</strong> <?php echo htmlspecialchars($row['delivery_date']); ?></p>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($row['client_name']); ?></p>
                
                <p><strong>Contenido del Paquete:</strong></p>
                <?php
                // Obtener los contenidos del paquete y la cantidad solicitada por cada artículo
                $sqlContenido = "SELECT i.name AS item_name, p.amount
                                 FROM Package p
                                 JOIN Item i ON p.item = i.code  
                                 WHERE p.shipment = ?";
                $stmtContenido = $conn->prepare($sqlContenido);
                $stmtContenido->bind_param("i", $row['shipment_id']);
                $stmtContenido->execute();
                $contenido = $stmtContenido->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmtContenido->close();
                ?>

                <?php foreach ($contenido as $item): ?>
                    <p> - <?php echo htmlspecialchars($item['item_name']) . ": " . htmlspecialchars($item['amount']); ?></p>
                <?php endforeach; ?>

                <p><strong>Estado:</strong> 
                    <?php echo ($row['status'] === 'Earring') ? 'Pendiente' : 'Finalizado'; ?>
                </p>

                <?php if ($row['status'] === 'Earring'): ?>
                    <form method="post">
                        <input type="hidden" name="shipment_id" value="<?php echo $row['shipment_id']; ?>">
                        <button type="submit">Marcar como Finalizado</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tienes pedidos asignados.</p>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
