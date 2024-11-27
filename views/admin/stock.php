<?php
// Remove the HTML structure since it will be embedded in the dashboard
?>
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title text-primary mb-4">Consulta de Inventario por Almacén</h2>
            
            <form action="?page=stock" method="POST" class="mb-4">
                <div class="row align-items-end">
                    <div class="col-md-8">
                        <label for="warehouse_code" class="form-label fw-bold">Selecciona el Almacén:</label>
                        <select id="warehouse_code" name="warehouse_code" class="form-select form-select-lg" required>
                            <?php
                            include '../../config/connection.php';
                            $sql = "SELECT code, name FROM Warehouse";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['code']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                                }
                            } else {
                                $default_warehouses = [
                                    'WH001' => 'Almacen Principal',
                                    'WH002' => 'Almacen Materia Prima',
                                    'WH003' => 'Almacen Producto Terminado',
                                    'WH004' => 'Almacen Refacciones',
                                    'WH005' => 'Almacen Empaque'
                                ];
                                foreach ($default_warehouses as $code => $name) {
                                    echo "<option value='" . htmlspecialchars($code) . "'>" . htmlspecialchars($name) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search me-2"></i>Consultar Inventario
                        </button>
                    </div>
                </div>
            </form>

            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                <div class="mt-4">
                    <?php
                    $selectedWarehouse = $_POST['warehouse_code'];
                    $sql = "SELECT name AS product_name, amount AS quantity 
                            FROM Stock
                            WHERE Stock.warehouse = ?";
                            
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $selectedWarehouse);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-secondary mb-0">Inventario del Almacén Seleccionado</h3>
                            <span class="badge bg-primary"><?php echo htmlspecialchars($selectedWarehouse); ?></span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">Producto</th>
                                        <th scope="col" class="text-center" style="width: 200px;">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                            <td class="text-center fw-bold"><?php echo htmlspecialchars($row['quantity']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>No hay inventario disponible para el almacén seleccionado.</div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
