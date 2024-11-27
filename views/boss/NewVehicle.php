<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Vehículo</title>
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Vehículo</h2>
        <form action="../../app/Controllers/newVehicles.php" method="POST">
            <div class="form-group">
                <label for="license_plate">Placa del Vehículo:</label>
                <input type="text" id="license_plate" name="license_plate" maxlength="15" required>
            </div>
            <div class="form-group">
                <label for="model">Modelo:</label>
                <input type="text" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="max_capacity">Capacidad Máxima (kg):</label>
                <input type="number" id="max_capacity" name="max_capacity" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="status">Estado:</label>
                <select id="status" name="status" required>
                    <option value="available">Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="warehouse">Asignar Almacén:</label>
                <select id="warehouse" name="warehouse" required>
                    <option value="">Seleccione un almacén</option>
                    <?php
                    include '../../config/connection.php';
                    $sql = "SELECT code, name FROM Warehouse";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['code'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    $conn->close(); 
                    ?>
                </select>
            </div>
            <button type="submit">Registrar Vehículo</button>
        </form>
    </div>
</body>
</html>
