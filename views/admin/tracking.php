<?php
include_once '../../config/connection.php';

$package_num = null; 

if (isset($_GET['tracking_code'])) {
    $tracking_code = $_GET['tracking_code'];

    $sql = "SELECT Shipment.num FROM Shipment WHERE Shipment.tracking_code = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparando la declaración: " . $conn->error);
    }

    $stmt->bind_param("s", $tracking_code);
    if (!$stmt->execute()) {
        die("Error ejecutando la consulta: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $package_num = $row['num']; 
    }
    $stmt->close();

    if ($package_num) {
        $sql = "SELECT Record.date, Record.location, Record.status 
                FROM Record 
                WHERE Record.shipment = ? 
                ORDER BY Record.date ASC"; 

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error preparando la declaración: " . $conn->error);
        }

        $stmt->bind_param("i", $package_num); 
        if (!$stmt->execute()) {
            die("Error ejecutando la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $records = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row; 
            }
        }
        $stmt->close();
    }
}
?>
<title>Tracking</title>
<?php include_once '../../views/partials/header.php'; ?>
<div class="form-container">
    <form method="GET" action="">
        <label for="tracking_code">Enter your tracking code:</label>
        <input type="text" id="tracking_code" name="tracking_code" required>
        <input type="submit" value="Track">
    </form>
</div>

<?php if (!empty($records)): ?>
    <div class="progress-bar">
        <div class="step">
            <div class="status-text">Tracking History</div>
            <div class="details">
                <?php
                foreach ($records as $record) {
                    echo "<div class='record-item'>";
                    echo "<p><strong>Date:</strong> " . $record['date'] . "</p>";
                    echo "<p><strong>Location:</strong> " . $record['location'] . "</p>";
                    echo "<p><strong>Status:</strong> " . $record['status'] . "</p>";
                    echo "</div><hr>"; // Separar cada registro con una línea
                }
                ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No tracking history available for this code.</p>
<?php endif; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 10rem;
        margin-bottom: 0px;
        background-color: #f4f4f9;
    }
    .form-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    label {
        font-weight: bold;
    }
    input[type="text"] {
        padding: 5px;
        margin-right: 10px;
    }
    input[type="submit"] {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
    .progress-bar {
        display: flex;
        justify-content: center;
        margin: 0 auto;
        width: 80%;
        max-width: 1000px;
    }
    .step {
        width: 100%;
        text-align: center;
        padding: 20px;
    }
    .status-text {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }
    .details {
        margin-top: 20px;
        font-size: 1rem;
    }
    .record-item {
        margin-bottom: 10px;
    }
    .record-item p {
        margin: 5px 0;
    }
    hr {
        margin-top: 20px;
        border-top: 1px solid #ccc;
    }
</style>

<?php include_once '../../views/partials/footer.php'; ?>
