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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex">
    <div class="w-64 bg-gray-800 text-white h-screen p-4 fixed">
        <h3 class="text-xl font-bold mb-4">Admin Panel</h3>
        <a href="admin_dashboard.php" class="block py-2 px-4 hover:bg-blue-500">🏠 Dashboard</a>
        <a href="medication_list.php" class="block py-2 px-4 hover:bg-blue-500">💊 Medication List</a>
        <a href="illness_list.php" class="block py-2 px-4 hover:bg-blue-500">🩺 Illness List</a>
        <a href="tables.php" class="block py-2 px-4 hover:bg-blue-500">📊 Tables</a>
        <a href="logout.php" class="block py-2 px-4 hover:bg-blue-500">🚪 Logout</a>
    </div>
    
    <div class="ml-64 p-4 w-full">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-4">GENTLE HANDS ORPHANAGE</h2>
            <h3 class="text-xl font-semibold mb-2">Filter by Category</h3>
            <select id="category_filter" onchange="filterCategory()" class="block w-full p-2 border border-gray-300 rounded mb-4">
                <option value="">Show All</option>
                <?php while ($category_row = mysqli_fetch_assoc($category_result)) { ?>
                    <option value="<?= $category_row['children_category'] ?>" <?= ($selected_category == $category_row['children_category']) ? "selected" : "" ?>>
                        <?= $category_row['children_category'] ?>
                    </option>
                <?php } ?>
            </select>

            <h3 class="text-xl font-semibold mb-2">Registered Users</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-center">ID</th>
                            <th class="py-2 px-4 border-b text-center">First Name</th>
                            <th class="py-2 px-4 border-b text-center">Last Name</th>
                            <th class="py-2 px-4 border-b text-center">Sex</th>
                            <th class="py-2 px-4 border-b text-center">Date of Birth</th>
                            <th class="py-2 px-4 border-b text-center">Date of Admission</th>
                            <th class="py-2 px-4 border-b text-center">Age of Admission</th>
                            <th class="py-2 px-4 border-b text-center">Current Age</th>
                            <th class="py-2 px-4 border-b text-center">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b text-center"><?= $row['id'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['first_name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['last_name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['sex'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['date_of_birth'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['date_of_admission'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['age_of_admission'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['current_age'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $row['children_category'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
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