<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <?php include '../partials/header.php'; ?>
</head>
<body class="register-body">
    <div class="register-container">
        <h1 class="title">Register Client</h1>
        <form action="../../app/Controllers/RegisterController.php" method="POST" class="register-form">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="input-group">
                <label for="surname">Second Last Name:</label>
                <input type="text" id="surname" name="surname">
            </div>
            <div class="input-group">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company">
            </div>
            <div class="input-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="input-group">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street">
            </div>
            <div class="input-group">
                <label for="colony">Neighborhood:</label>
                <input type="text" id="colony" name="colony">
            </div>
            <div class="input-group">
                <label for="number">Number:</label>
                <input type="text" id="number" name="number">
            </div>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        <button><a href="../auth/LoginViewUser.php">Login</a></button>
    </div>    
</body>
</html>
