<?php
session_start();
$client_username = isset($_SESSION['client_username']) ? $_SESSION['client_username'] : 'Usuario no definido';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Incidente</title>
</head>
<body>
    <h1>Reportar Incidente</h1>
    <form action="../../app/Controllers/incidentController.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($client_username); ?>" readonly required><br><br>

        <label for="description">Descripción del incidente:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="date">Fecha del incidente:</label>
        <input type="date" id="date" name="date" required><br><br>

        <input type="submit" value="Enviar Reporte">
    </form>
</body>
</html>