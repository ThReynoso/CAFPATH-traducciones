<?php
include '../../config/connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    die("Unauthorized access. Please log in.");
}

$supervisor_username = $_SESSION['username'];

$sql = "SELECT warehouse FROM Employees WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $supervisor_username);
$stmt->execute();
$stmt->bind_result($warehouse_code);
$stmt->fetch();
$stmt->close();

if (!$warehouse_code) {
    die("Error: Could not retrieve the supervisor's warehouse.");
}

echo "Supervisor's warehouse: " . $warehouse_code . "<br>";

$today = date("Y-m-d");
echo "Today's date: $today<br>"; 
$sqlEmployees = "SELECT E.num, E.name, E.lastname, E.surname 
                 FROM Employees E
                 WHERE E.role = 'R003' AND E.warehouse = ? AND E.status = 'available'";
$stmtEmployees = $conn->prepare($sqlEmployees);
$stmtEmployees->bind_param("s", $warehouse_code);
$stmtEmployees->execute();
$employees = $stmtEmployees->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtEmployees->close();

$sqlVehicles = "SELECT V.number, V.license_plate, V.model
                FROM Vehicle V
                WHERE V.warehouse = ? AND V.status = 'available'";
$stmtVehicles = $conn->prepare($sqlVehicles);
$stmtVehicles->bind_param("s", $warehouse_code);
$stmtVehicles->execute();
$availableVehicles = $stmtVehicles->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtVehicles->close();

$sqlPackages = "SELECT DISTINCT S.num, CONCAT(C.street, ' ', C.number, ', ', C.colony) AS destination_address
                FROM Record R
                JOIN Shipment S ON R.shipment = S.num
                JOIN Client C ON S.client = C.num
                WHERE S.warehouse = ? AND S.vehicle IS NULL AND S.path IS NULL
                GROUP BY R.shipment
                HAVING COUNT(DISTINCT R.status) = 2
                ORDER BY S.num ASC";
$stmtPackages = $conn->prepare($sqlPackages);
$stmtPackages->bind_param("s", $warehouse_code);
$stmtPackages->execute();
$availablePackages = $stmtPackages->get_result()->fetch_all(MYSQLI_ASSOC);
$stmtPackages->close();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['packages'], $_POST['employee_num'], $_POST['vehicle_number'], $_POST['starting_date'], $_POST['arrival_date'])) {
    $selectedPackages = $_POST['packages'];
    $selectedEmployee = $_POST['employee_num'];
    $selectedVehicle = $_POST['vehicle_number'];
    $startDate = $_POST['starting_date'];
    $arrivalDate = $_POST['arrival_date'];

    $routeCode = rand(100000, 999999);
    $lastPackage = end($selectedPackages);
    
    $sqlLastPackage = "SELECT CONCAT(C.street, ' ', C.number, ', ', C.colony) AS destination_address
                       FROM Shipment S
                       JOIN Client C ON S.client = C.num
                       WHERE S.num = ?";
    $stmtLastPackage = $conn->prepare($sqlLastPackage);
    $stmtLastPackage->bind_param("i", $lastPackage);
    $stmtLastPackage->execute();
    $stmtLastPackage->bind_result($destinationAddress);
    $stmtLastPackage->fetch();
    $stmtLastPackage->close();

    if (!$destinationAddress) {
        die("Error: Could not retrieve the address for the last selected package.");
    }
    $sqlInsertRoute = "INSERT INTO Path (starting_point, end_point, est_arrival, starting_date, id_ruta) VALUES (?, ?, ?, ?, ?)";
    $stmtRoute = $conn->prepare($sqlInsertRoute);
    $stmtRoute->bind_param("ssssi", $warehouse_code, $destinationAddress, $arrivalDate, $startDate, $routeCode);
    $stmtRoute->execute();
    $newRouteId = $stmtRoute->insert_id;
    $stmtRoute->close();

    if (!$newRouteId) {
        die("Error: Could not create the new route.");
    }

    $sqlInsertRouteDetails = "INSERT INTO RutaDetalles (id_vehiculo, fecha, orden_entrega, id_paquete, direccion_destino, id_ruta) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtRouteDetails = $conn->prepare($sqlInsertRouteDetails);
    
    foreach ($selectedPackages as $package) {
        $sqlAddress = "SELECT CONCAT(C.street, ' ', C.number, ', ', C.colony) AS destination_address
                       FROM Shipment S
                       JOIN Client C ON S.client = C.num
                       WHERE S.num = ?";
        $stmtAddress = $conn->prepare($sqlAddress);
        $stmtAddress->bind_param("i", $package);
        $stmtAddress->execute();
        $stmtAddress->bind_result($packageAddress);
        $stmtAddress->fetch();
        $stmtAddress->close();
    
        if ($packageAddress) {
            $stmtRouteDetails->bind_param("issisi", $selectedVehicle, $startDate, $routeCode, $package, $packageAddress, $newRouteId);
            $stmtRouteDetails->execute();
        }
    }
    $stmtRouteDetails->close();

    $sqlUpdateShipment = "UPDATE Shipment SET vehicle = ?, path = ? WHERE num = ?";
    $stmtUpdateShipment = $conn->prepare($sqlUpdateShipment);

    foreach ($selectedPackages as $package) {
        $stmtUpdateShipment->bind_param("iii", $selectedVehicle, $newRouteId, $package);
        $stmtUpdateShipment->execute();
    }
    $stmtUpdateShipment->close();

    $sqlCheckAssignment = "SELECT * FROM Vehicle_Assignment WHERE vehicle_number = ? AND employee_num = ? AND assigned_date = ?";
    $stmtCheckAssignment = $conn->prepare($sqlCheckAssignment);
    $stmtCheckAssignment->bind_param("iis", $selectedVehicle, $selectedEmployee, $today);
    $stmtCheckAssignment->execute();
    $resultCheck = $stmtCheckAssignment->get_result();

    if ($resultCheck->num_rows === 0) {
        $sqlInsertVehicleAssignment = "INSERT INTO Vehicle_Assignment (vehicle_number, employee_num, assigned_date) 
                                       VALUES (?, ?, ?)";
        $stmtVehicleAssignment = $conn->prepare($sqlInsertVehicleAssignment);
        $stmtVehicleAssignment->bind_param("iis", $selectedVehicle, $selectedEmployee, $today);
        $stmtVehicleAssignment->execute();
        $stmtVehicleAssignment->close();
        echo "Vehicle assignment created successfully.";
    } else {
        echo "Error: Vehicle assignment already exists for this employee and vehicle on the current date.";
    }
    $stmtCheckAssignment->close();

    $sqlUpdateVehicle = "UPDATE Vehicle SET status = 'occupied' WHERE number = ?";
    $stmtUpdateVehicle = $conn->prepare($sqlUpdateVehicle);
    $stmtUpdateVehicle->bind_param("i", $selectedVehicle);
    $stmtUpdateVehicle->execute();
    $stmtUpdateVehicle->close();
    
    echo "Route created successfully with ID: " . $newRouteId . " and Route Code: " . $routeCode;
} else {
    echo "Please complete all form fields.";
}

$conn->close();
?>

<body>
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title mb-0">Create a New Route</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="createPath.php" class="needs-validation" novalidate>
                    <!-- Employees Section -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3">Available Employees</h3>
                        <?php if (!empty($employees)): ?>
                            <div class="form-group">
                                <select name="employee_num" class="form-select" required>
                                    <option value="">Select an employee...</option>
                                    <?php foreach ($employees as $employee): ?>
                                        <option value="<?php echo $employee['num']; ?>">
                                            <?php echo $employee['name'] . " " . $employee['lastname']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">No available employees.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Vehicles Section -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3">Select Vehicle</h3>
                        <?php if (!empty($availableVehicles)): ?>
                            <div class="form-group">
                                <select name="vehicle_number" class="form-select" required>
                                    <option value="">Select a vehicle...</option>
                                    <?php foreach ($availableVehicles as $vehicle): ?>
                                        <option value="<?php echo $vehicle['number']; ?>">
                                            <?php echo "ID: " . $vehicle['number'] . " - " . $vehicle['license_plate'] . " (" . $vehicle['model'] . ")"; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">No available vehicles.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Packages Section -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3">Available Packages</h3>
                        <?php if (!empty($availablePackages)): ?>
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <?php foreach ($availablePackages as $package): ?>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="packages[]" 
                                                   value="<?php echo $package['num']; ?>" id="package<?php echo $package['num']; ?>">
                                            <label class="form-check-label" for="package<?php echo $package['num']; ?>">
                                                Package <?php echo $package['num']; ?>
                                                <small class="d-block text-muted">
                                                    <?php echo $package['destination_address']; ?>
                                                </small>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">No available packages.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Dates Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Starting Date</label>
                                <input type="date" name="starting_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Estimated Arrival Date</label>
                                <input type="date" name="arrival_date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Create Route</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

