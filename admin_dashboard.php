<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$selected_category = isset($_GET['category']) ? $_GET['category'] : "";
$category_query = "SELECT DISTINCT children_category FROM users WHERE children_category != ''";
$category_result = mysqli_query($conn, $category_query);

$sql = !empty($selected_category) ? "SELECT * FROM users WHERE children_category = '$selected_category'" : "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px gray;
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
        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            justify-content: center;
        }
        .button {
            padding: 10px 15px;
            background: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            width: 200px;
        }
        .button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
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
            <h2>G.H. Orphanage Dashboard</h2>
            <h3>Filter by Category</h3>
            <select id="category_filter" onchange="filterCategory()">
                <option value="">Show All</option>
                <?php while ($category_row = mysqli_fetch_assoc($category_result)) { ?>
                    <option value="<?= $category_row['children_category'] ?>" <?= ($selected_category == $category_row['children_category']) ? "selected" : "" ?>>
                        <?= $category_row['children_category'] ?>
                    </option>
                <?php } ?>
            </select>

            <h3>Registered Users</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Date of Birth</th>
                    <th>Date of Admission</th>
                    <th>Age of Admission</th>
                    <th>Current Age</th>
                    <th>Category</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['sex'] ?></td>
                        <td><?= $row['date_of_birth'] ?></td>
                        <td><?= $row['date_of_admission'] ?></td>
                        <td><?= $row['age_of_admission'] ?></td>
                        <td><?= $row['current_age'] ?></td>
                        <td><?= $row['children_category'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script>
        function filterCategory() {
            let category = document.getElementById("category_filter").value;
            window.location.href = "admin_dashboard.php?category=" + category;
        }
    </script>
</body>
</html>
