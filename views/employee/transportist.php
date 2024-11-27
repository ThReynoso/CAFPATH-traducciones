<?php 
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'R003') {
    header("Location: ../auth/LoginViewEmployee.php");
    exit();
}
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/LoginViewEmployee.php");
    exit();
}

$username = $_SESSION['username'];
?>
<script src="../../assets/js/main.js" defer></script>
<link rel="stylesheet" href="../../assets/css/style.css">
<div class="layout">
    <header>
        <?php include '../partials/header.php'; ?>
    </header>
    <nav>
        <ul style="list-style-type: none;">
            <br><br><br>
            <li><a href="pathTransportist.php">Path Transportist</a></li>
            <br>
        </ul>
    </nav>
    
    <main id="main-content">
    <h2>Bienvenido, <?php echo htmlspecialchars($username); ?></h2>
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
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('main-content').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching content:', error);
                document.getElementById('main-content').innerHTML = "<p>Error al cargar el contenido.</p>";
            });
    }

    document.getElementById('link-tracking').addEventListener('click', function(event) {
        event.preventDefault();
        loadContent('tracking.html');
    });

</script>