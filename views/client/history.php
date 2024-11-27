<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../../index.php"); 
    exit();
}

include '../../config/connection.php';

$client_id = $_SESSION['client_id'];

$sql = "SELECT s.num AS shipment_id, s.date AS order_date, s.delivery_date, r.status 
        FROM Shipment s 
        JOIN Record r ON s.num = r.shipment 
        WHERE s.client = ? 
        ORDER BY s.date DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Pedidos</title>
</head>
<body>
    <h1>Historial de Pedidos</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha de Pedido</th>
                <th>Fecha de Entrega</th>
                <th>Último Estatus</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['shipment_id']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No tienes pedidos en tu historial.</p>
    <?php endif; ?>

    <a href="index.php">Volver a la Página Principal</a>
</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>
