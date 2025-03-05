<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch medications from the database
$medication_query = "SELECT * FROM medications";
$medication_result = mysqli_query($conn, $medication_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medication List</title>
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
        .btn-add {
            background: green;
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
            <h2>Medication List</h2>

            <div class="btn-container">
                <a href="admin_dashboard.php" class="btn btn-back">Back to Dashboard</a>
                <a href="add_medication.php" class="btn btn-add">Add Medication</a>
            </div>

            <table>
                <tr>
                    <th>Patient Name</th>
                    <th>Prescribed by</th>
                    <th>Medicine Name</th>
                    <th>Strength</th>
                    <th>Mg/Kg/Day</th>
                    <th>Dose</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Day</th>
                    <th>Week</th>
                    <th>Month</th>
                </tr>
                <?php while ($medication = mysqli_fetch_assoc($medication_result)) { ?>
                    <tr>
                        <td><?= $medication['patient_name'] ?></td>
                        <td><?= $medication['prescribed_by'] ?></td>
                        <td><?= $medication['medicine_name'] ?></td>
                        <td><?= $medication['strength'] ?></td>
                        <td><?= $medication['mg_kg_day'] ?></td>
                        <td><?= $medication['dose'] ?></td>
                        <td><?= $medication['frequency'] ?></td>
                        <td><?= $medication['duration'] ?></td>
                        <td><?= $medication['day'] ?></td>
                        <td><?= $medication['week'] ?></td>
                        <td><?= $medication['month'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>
