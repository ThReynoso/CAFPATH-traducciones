<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../auth/LoginViewUser.php"); 
    exit;
}

$client_username = $_SESSION['client_username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio del Cliente</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/main.js" defer></script>
</head>
<body>
    <div class="layout">
        <header>
            <?php include '../partials/header.php'; ?>
        </header>
        <nav>
            <ul style="list-style-type: none;">
                <br><br><br>
                <li><a id="link-infoPackages" style="text-decoration: none; color: var(--white);">Ver pedidos</a></li>
                <br>
                <li><a id="link-profile" style="text-decoration: none; color: var(--white);">Perfil</a></li>
                <br>
                <li><a id="link-reportIncident" style="text-decoration: none; color: var(--white);">Reportar un incidente</a></li>
                <br>
                <li><a href="../../index.php" style="text-decoration: none; color: var(--white);">Cerrar sesión</a></li>
            </ul>
        </nav>
        <main id="main-content">
            <h2>Bienvenido, <?php echo htmlspecialchars($client_username); ?>!</h2>
            <p>Has iniciado sesión exitosamente. Aquí puedes gestionar tus paquetes y configuraciones.</p>
            <section>
                <h3>Últimas Noticias</h3>
                <p>¡Mantente informado con las últimas actualizaciones y noticias!</p>
            </section>
            <section>
                <h3>Ofertas Especiales</h3>
                <p>Descubre nuestras ofertas exclusivas para clientes registrados.</p>
            </section>
        </main>
        <article class="widget">Info</article>
    <article class="stats">Stats</article>
        <footer>
            <?php include '../partials/footer.php'; ?>
        </footer>
    </div>

    <script>
        function loadContent(url) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('main-content').innerHTML = data;
                })
                .catch(error => console.error('Error fetching content:', error));
        }

        document.getElementById('link-infoPackages').addEventListener('click', function() {
            loadContent('infoPackages.php');
        });

        document.getElementById('link-profile').addEventListener('click', function() {
            loadContent('clientInfo.php');
        });

        document.getElementById('link-reportIncident').addEventListener('click', function() {
            loadContent('reportIncident.php');
        });
    </script>
</body>
</html>