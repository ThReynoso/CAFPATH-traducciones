<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track a package</title>
</head>
<?php include_once '../partials/header.php'; ?>
<body class="bg-body">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Track Your Package</h3>
                        <form id="trackingForm" method="GET" action="">
                            <div class="mb-3">
                                <label for="tracking_code" class="form-label">Ingrese su código de rastreo:</label>
                                <input type="text" class="form-control" id="tracking_code" name="tracking_code" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Rastrear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="tracking-results" class="mt-4">
            <?php 
            if (isset($_GET['tracking_code'])) {
                include_once '../../app/Controllers/trackingController.php';
            }
            ?>
        </div>
    </div>

    <script src="../../assets/js/tracking.js"></script>
</body>
</html>