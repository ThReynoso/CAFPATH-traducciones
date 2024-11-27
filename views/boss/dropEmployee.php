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
$sql = "SELECT warehouse FROM Employees WHERE num = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $supervisor_id);
$stmt->execute();
$stmt->bind_result($warehouse_code);
$stmt->fetch();
$stmt->close();

if (!$warehouse_code) {
    die("Error: No se obtuvo el almacén del supervisor.");
}

$sqlEmpleados = "SELECT num, name, lastname, surname FROM Employees WHERE warehouse = ?";
$stmtEmpleados = $conn->prepare($sqlEmpleados);
$stmtEmpleados->bind_param("s", $warehouse_code);
$stmtEmpleados->execute();
$empleados = $stmtEmpleados->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtEmpleados->close();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['employee_num'])) {
    $employeeNum = $_POST['employee_num'];

    $sqlDeleteEmployee = "DELETE FROM Employees WHERE num = ?";
    $stmtDelete = $conn->prepare($sqlDeleteEmployee);
    $stmtDelete->bind_param("i", $employeeNum);

    if ($stmtDelete->execute()) {
        echo "Empleado eliminado exitosamente.";
    } else {
        echo "Error al eliminar el empleado: " . $stmtDelete->error;
    }

    $stmtDelete->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Empleado</title>
</head>
<body>
    <h2>Eliminar Empleado</h2>

    <?php if (!empty($empleados)): ?>
        <form method="POST" action="deleteEmployee.php">
            <label for="employee_num">Selecciona un empleado:</label>
            <select name="employee_num" id="employee_num" required>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?php echo $empleado['num']; ?>">
                        <?php echo $empleado['name'] . ' ' . $empleado['lastname'] . ' ' . $empleado['surname']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Eliminar Empleado</button>
        </form>
    <?php else: ?>
        <p>No hay empleados disponibles en su almacén.</p>
    <?php endif; ?>
</body>
</html>
