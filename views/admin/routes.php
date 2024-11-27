<?php
session_start();
include '../../config/connection.php'; 

if (!isset($_SESSION['num'])) {  
    die("Acceso no autorizado. Por favor inicie sesión.");
}

$sql_rutas = "SELECT DISTINCT r.id_ruta, r.fecha, r.orden_entrega, r.id_vehiculo 
               FROM RutaDetalles AS r
               ORDER BY r.orden_entrega ASC";

$stmt_rutas = $conn->prepare($sql_rutas);
$stmt_rutas->execute();
$result_rutas = $stmt_rutas->get_result();
$rutas = $result_rutas->fetch_all(MYSQLI_ASSOC);

if ($stmt_rutas->error) {
    echo "Error: " . $stmt_rutas->error;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rutas Disponibles</title>
</head>
<body>
    <h1>Rutas Disponibles</h1>

    <?php if ($rutas): ?>
        <?php foreach ($rutas as $ruta): ?>
            <h2>Ruta ID: <?php echo htmlspecialchars($ruta['id_ruta']); ?></h2>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($ruta['fecha']); ?></p>
            <p><strong>Orden de Entrega:</strong> <?php echo htmlspecialchars($ruta['orden_entrega']); ?></p>
           
            <table border="1">
                <tr>
                    <th>ID Paquete</th>
                    <th>CLiente</th>
                    <th>Calle</th>
                    <th>Colonia</th>
                    <th>Número</th>
                </tr>
                <?php
                $sql_detalles = "SELECT S.num AS paquete, CONCAT(c.name, ' ', c.lastname, ' ', COALESCE(c.surname, '')) AS cliente, 
                c.street, c.colony, c.number
         FROM RutaDetalles AS r
         JOIN Shipment AS S ON r.id_paquete = S.num
         JOIN Client AS c ON S.client = c.num
         WHERE r.id_ruta = ?";

                $stmt_detalles = $conn->prepare($sql_detalles);
                $stmt_detalles->bind_param("i", $ruta['id_ruta']);
                $stmt_detalles->execute();
                $result_detalles = $stmt_detalles->get_result();
                $detalles = $result_detalles->fetch_all(MYSQLI_ASSOC);

                if ($detalles): 
                    foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($detalle['paquete']); ?></td>
                            <td><?php echo htmlspecialchars($detalle['cliente']); ?></td>
                            <td><?php echo htmlspecialchars($detalle['street']); ?></td>
                            <td><?php echo htmlspecialchars($detalle['colony']); ?></td>
                            <td><?php echo htmlspecialchars($detalle['number']); ?></td>
                        </tr>
                    <?php endforeach; 
                else: ?>
                    <tr>
                        <td colspan="5">No se encontraron detalles para esta ruta.</td>
                    </tr>
                <?php endif; ?>
            </table>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron rutas disponibles.</p>
    <?php endif; ?>

</body>
</html>


