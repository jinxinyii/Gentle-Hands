<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM illnesses"; 
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn)); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Illness List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 15px;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #007bff;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px gray;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .btn-back {
            background: red;
        }
        .btn-print {
            background: #17a2b8;
        }
        .btn:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f1f1f1;
        }
    </style>
    <script>
        function printTable() {
            window.print();
        }
    </script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="admin_dashboard.php">🏠 Dashboard</a>
        <a href="medication_list.php">💊 Medication List</a>
        <a href="illness_list.php">🩺 Illness List</a>
        <a href="tables.php">📊 Tables</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="content">
        <div class="container">
            <h2>Illness List</h2>

            <div class="btn-container">
                <a href="admin_dashboard.php" class="btn btn-back">Back to Dashboard</a>
                <a href="#" class="btn btn-print" onclick="printTable()">Print</a>
            </div>

            <h3>Child Information</h3>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Birthdate</th>
                    <th>Current Age</th>
                    <th>Date of Birth</th>
                </tr>
                <?php while ($illness = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $illness['child_name'] ?></td>
                        <td><?= $illness['birthdate'] ?></td>
                        <td><?= $illness['current_age'] ?></td>
                        <td><?= $illness['date_of_birth'] ?></td>
                    </tr>
                <?php } ?>
            </table>

            <h3>Illness Records</h3>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Illness/Treatment</th>
                    <th>Medication</th>
                    <th>Mg/Kg/Day</th>
                    <th>Dose</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Start</th>
                    <th>End</th>
                </tr>
                <?php 
                mysqli_data_seek($result, 0); // Reset pointer for reuse
                while ($illness = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $illness['date'] ?></td>
                        <td><?= $illness['illness_treatment'] ?></td>
                        <td><?= $illness['medication'] ?></td>
                        <td><?= $illness['mg_kg_day'] ?></td>
                        <td><?= $illness['dose'] ?></td>
                        <td><?= $illness['frequency'] ?></td>
                        <td><?= $illness['duration'] ?></td>
                        <td><?= $illness['start_date'] ?></td>
                        <td><?= $illness['end_date'] ?></td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
</div>

</body>
</html>
