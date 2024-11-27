<?php
session_start();
include '../../config/connection.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_SESSION['num'])) {  
    die("Acceso no autorizado. Por favor inicie sesión.");
}

$supervisor_id = $_SESSION['num'];

$query_warehouse = "SELECT warehouse FROM Employees WHERE num = ?";
$stmt_warehouse = $conn->prepare($query_warehouse);
$stmt_warehouse->bind_param("i", $supervisor_id);
$stmt_warehouse->execute();
$result_warehouse = $stmt_warehouse->get_result();

if ($result_warehouse->num_rows > 0) {
    $row = $result_warehouse->fetch_assoc();
    $warehouse_code = $row['warehouse'];

    // Consulta para obtener los datos de los paquetes en el almacén del supervisor
    $query = "
        SELECT 
            Client.name AS client_name,
            Client.lastname AS client_lastname,
            Client.email AS client_email,
            Item.name AS item_name,
            Item.description AS item_description,
            Package.amount AS item_amount,
            Insurance.policyNumber AS policy_number,
            Insurance.insurance_type AS insurance_type,
            Insurance.coverage AS insurance_coverage,
            Record.date AS record_date,
            Record.location AS record_location,
            Record.status AS record_status
        FROM 
            Shipment
        INNER JOIN Client ON Shipment.client = Client.num
        INNER JOIN Package ON Shipment.num = Package.shipment
        INNER JOIN Item ON Package.item = Item.code
        INNER JOIN Insurance ON Shipment.insurance = Insurance.num
        INNER JOIN Record ON Record.shipment = Shipment.num
        WHERE Shipment.warehouse = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $warehouse_code);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar resultados
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Artículo</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Póliza</th>
                    <th>Tipo de Seguro</th>
                    <th>Cobertura</th>
                    <th>Fecha Registro</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['client_name']} {$row['client_lastname']}</td>
                    <td>{$row['client_email']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['item_description']}</td>
                    <td>{$row['item_amount']}</td>
                    <td>{$row['policy_number']}</td>
                    <td>{$row['insurance_type']}</td>
                    <td>{$row['insurance_coverage']}</td>
                    <td>{$row['record_date']}</td>
                    <td>{$row['record_location']}</td>
                    <td>{$row['record_status']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron paquetes en este almacén.";
    }
} else {
    echo "No se pudo determinar el almacén del supervisor.";
}

// Cerrar la conexión
$conn->close();
?>
