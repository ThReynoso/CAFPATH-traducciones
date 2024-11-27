<?php 
session_start();
include '../../config/connection.php';

if (!isset($_SESSION['num'])) {
    die("Acceso no autorizado. Por favor inicie sesión.");
}

$supervisor_id = $_SESSION['num'];

// Obtener el código del almacén del supervisor
$sql = "SELECT warehouse FROM Employees WHERE num = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $supervisor_id);
$stmt->execute();
$stmt->bind_result($warehouse_code);
$stmt->fetch();
$stmt->close();

// Obtener operadores del almacén
$sqlOperators = "SELECT emp.num AS employee_id, emp.name, emp.lastname, emp.surname 
                 FROM Employees emp
                 JOIN Role rol ON emp.role = rol.code
                 WHERE rol.code = 'R002' AND emp.warehouse = ?";
$stmtOperators = $conn->prepare($sqlOperators);
$stmtOperators->bind_param("s", $warehouse_code);
$stmtOperators->execute();
$operators = $stmtOperators->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtOperators->close();

// Obtener pedidos pendientes en el almacén
$sqlOrders = "SELECT sh.num AS shipment_id, sh.date, cl.street, cl.colony, cl.number
              FROM Shipment sh
              JOIN Client cl ON sh.client = cl.num
              JOIN Record rec ON rec.shipment = sh.num
              WHERE rec.status = 'Order Placed' AND sh.vehicle IS NULL AND sh.path IS NULL
              AND sh.warehouse = ? 
              AND NOT EXISTS (
                  SELECT 1 FROM Record rec2 
                  WHERE rec2.shipment = sh.num 
                  AND rec2.status != 'Order Placed'
              )";
$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->bind_param("s", $warehouse_code);
$stmtOrders->execute();
$orders = $stmtOrders->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtOrders->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_id']) && isset($_POST['shipment_id'])) {
    $employee_id = $_POST['employee_id'];
    $shipment_id = $_POST['shipment_id'];

    // Insertar en la tabla Assamble con estado 'Earring'
    $sqlAssign = "INSERT INTO Assamble (employees, shipment, status) VALUES (?, ?, 'Earring')";
    $stmtAssign = $conn->prepare($sqlAssign);
    $stmtAssign->bind_param("ii", $employee_id, $shipment_id);

    if ($stmtAssign->execute()) {
        $sqlUpdateStatus = "INSERT INTO Record (date, location, status, client, shipment)
                            VALUES (CURDATE(), NULL, 'In Process', 
                                    (SELECT client FROM Shipment WHERE num = ?), ?)";
        $stmtUpdateStatus = $conn->prepare($sqlUpdateStatus);
        $stmtUpdateStatus->bind_param("ii", $shipment_id, $shipment_id);
        
        if ($stmtUpdateStatus->execute()) {
            echo "El pedido ha sido asignado al empleado con estatus 'Earring' y el registro ha cambiado a 'In Process'.";
        } else {
            echo "Error al actualizar el estatus del pedido: " . $stmtUpdateStatus->error;
        }
        $stmtUpdateStatus->close();
    } else {
        echo "Error al asignar el pedido al empleado: " . $stmtAssign->error;
    }
    $stmtAssign->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Pedido a Empleado Operador</title>
</head>
<body>
    <h2>Asignar Pedido a Empleado Operador</h2>
    
    <form method="POST">
        <h3>Seleccione un Empleado Operador</h3>
        <select name="employee_id" required>
            <?php foreach ($operators as $operator): ?>
                <option value="<?php echo $operator['employee_id']; ?>">
                    <?php echo $operator['name'] . " " . $operator['lastname'] . " " . $operator['surname']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <h3>Seleccione un Pedido para Asignar</h3>
        <select name="shipment_id" required>
            <?php foreach ($orders as $order): ?>
                <option value="<?php echo $order['shipment_id']; ?>">
                    <?php echo "Pedido ID: " . $order['shipment_id'] . " - Dirección: " . $order['street'] . ", " . $order['colony'] . " " . $order['number']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Asignar Pedido</button>
    </form>
</body>
</html>
