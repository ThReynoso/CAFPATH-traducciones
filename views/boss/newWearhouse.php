<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Almacén</title>
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Almacén</h2>
        <form action="../../app/Controllers/newWearhouse.php" method="POST">
            <div class="form-group">
                <label for="code">Código del Almacén:</label>
                <input type="text" id="code" name="code" maxlength="6" required>
            </div>
            <div class="form-group">
                <label for="name">Nombre del Almacén:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="street">Calle:</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div class="form-group">
                <label for="colony">Colonia:</label>
                <input type="text" id="colony" name="colony" required>
            </div>
            <div class="form-group">
                <label for="number">Número:</label>
                <input type="text" id="number" name="number" required>
            </div>
            <button type="submit">Registrar Almacén</button>
        </form>
    </div>
</body>
</html>
