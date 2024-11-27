<?php
session_start();
include '../../config/connection.php'; 

if (!isset($_SESSION['client_id'])) {
    header("Location: ../../login.php");
    exit();
}

$client_id = $_SESSION['client_id']; 

$sql_orders = "SELECT s.num, s.date, s.delivery_date
               FROM Shipment AS s
               WHERE s.client = ?"; 

$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $client_id); 
$stmt_orders->execute(); 
$result_orders = $stmt_orders->get_result(); 
$orders = $result_orders->fetch_all(MYSQLI_ASSOC); 

if ($stmt_orders->error) {
    echo "Error: " . $stmt_orders->error; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información de los Pedidos</title>
</head>
<body>
    <h2>Mis Pedidos</h2>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha de Pedido</th>
            <th>Fecha de Entrega</th>
            <th>Acción</th> 
        </tr>
        <?php if ($orders): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['num']); ?></td>
                    <td><?php echo htmlspecialchars($order['date']); ?></td>
                    <td><?php echo htmlspecialchars($order['delivery_date']); ?></td>
                    <td>
                        <form action="../../app/Controllers/infoPackages.php" method="get">
                            <input type="hidden" name="pedido_id" value="<?php echo htmlspecialchars($order['num']); ?>">
                            <button type="submit">Rastrear</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No tienes pedidos realizados.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
