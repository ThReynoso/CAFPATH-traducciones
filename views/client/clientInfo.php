<?php
session_start();
include '../../config/connection.php'; 

if (!isset($_SESSION['client_id'])) {
    header("Location: ../../login.php");
    exit();
}

$client_id = $_SESSION['client_id']; 

$sql_client = "SELECT c.num, c.name, c.lastname, c.surname, c.company, c.phone, c.street, c.colony, c.number
               FROM Client AS c
               WHERE c.num = ?"; 

$stmt_client = $conn->prepare($sql_client);
$stmt_client->bind_param("i", $client_id); 
$stmt_client->execute(); 
$result_client = $stmt_client->get_result(); 
$client = $result_client->fetch_assoc(); 

if ($stmt_client->error) {
    echo "Error: " . $stmt_client->error;
}

if (!$client) {
    $client = []; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información del Cliente</title>
</head>
<body>
    <h1>Información del Cliente</h1>

    <?php if ($client): ?>
        <p><strong>ID del Cliente:</strong> <?php echo htmlspecialchars($client['num']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($client['name']); ?></p>
        <p><strong>Apellido Paterno:</strong> <?php echo htmlspecialchars($client['lastname']); ?></p>
        <p><strong>Apellido Materno:</strong> <?php echo htmlspecialchars($client['surname']); ?></p>
        <p><strong>Empresa:</strong> <?php echo htmlspecialchars($client['company']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($client['phone']); ?></p>
        <p><strong>Calle:</strong> <?php echo htmlspecialchars($client['street']); ?></p>
        <p><strong>Colonia:</strong> <?php echo htmlspecialchars($client['colony']); ?></p>
        <p><strong>Número:</strong> <?php echo htmlspecialchars($client['number']); ?></p>
    <?php else: ?>
        <p>No se encontró información del cliente.</p>
    <?php endif; ?>
</body>
</html>