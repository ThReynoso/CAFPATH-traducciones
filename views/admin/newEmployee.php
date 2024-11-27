<body class="new-employee-body">
    <div class="new-employee-container">
        <h1 class="title">Register Employee</h1>
        <form class="new-employee-form" action="../../app/Controllers/newEmployees.php" method="POST">
            <div class="input-group">
                <label for="name">First Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="input-group">
                <label for="surname">Middle Name:</label>
                <input type="text" id="surname" name="surname">
            </div>
            <div class="input-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="R002">Operator</option>
                    <option value="R003">Driver</option>
                </select>
            </div>
            <div class="input-group">
                <label for="warehouse_code">Warehouse:</label>
                <select id="warehouse_code" name="warehouse_code" required>
                    <?php
                    include '../../config/connection.php';

                    $sql = "SELECT code, name FROM Warehouse";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['code'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value='WH001'>Main Warehouse (WH001)</option>";
                        echo "<option value='WH002'>Raw Material Warehouse (WH002)</option>";
                        echo "<option value='WH003'>Finished Product Warehouse (WH003)</option>";
                        echo "<option value='WH004'>Spare Parts Warehouse (WH004)</option>";
                        echo "<option value='WH005'>Packaging Warehouse (WH005)</option>";
                    }

                    $conn->close(); 
                    ?>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
