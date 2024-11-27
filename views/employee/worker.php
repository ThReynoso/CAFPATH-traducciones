<?php 
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'R002') {
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
            <li><a href="forme.php">Assign Package</a></li>
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

