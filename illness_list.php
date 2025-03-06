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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Illness List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function printTable() {
            window.print();
        }
    </script>
</head>
<body class="bg-gray-100">
<div class="flex">
    <div class="w-64 bg-gray-800 text-white h-screen p-4 fixed">
        <h3 class="text-xl font-bold mb-4">ADMIN PANEL</h3>
        <a href="admin_dashboard.php" class="block py-2 px-4 hover:bg-blue-500">🏠 Dashboard</a>
        <a href="medication_list.php" class="block py-2 px-4 hover:bg-blue-500">💊 Medication List</a>
        <a href="illness_list.php" class="block py-2 px-4 hover:bg-blue-500">🩺 Illness List</a>
        <a href="tables.php" class="block py-2 px-4 hover:bg-blue-500">📊 Tables</a>
        <a href="logout.php" class="block py-2 px-4 hover:bg-blue-500">🚪 Logout</a>
    </div>

    <div class="ml-64 p-4 w-full">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-4">Illness List</h2>

            <div class="flex justify-between mb-4">
                <a href="admin_dashboard.php" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Back to Dashboard</a>
                <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" onclick="printTable()">Print</a>
            </div>

            <h3 class="text-xl font-semibold mb-2">Child Information</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Full Name</th>
                            <th class="py-2 px-4 border-b text-center">Birthdate</th>
                            <th class="py-2 px-4 border-b text-center">Current Age</th>
                            <th class="py-2 px-4 border-b text-center">Date of Birth</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($illness = mysqli_fetch_assoc($result)) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b text-center"><?= $illness['child_name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['birthdate'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['current_age'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['date_of_birth'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <h3 class="text-xl font-semibold mb-2">Illness Records</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Date</th>
                            <th class="py-2 px-4 border-b text-center">Illness/Treatment</th>
                            <th class="py-2 px-4 border-b text-center">Medication</th>
                            <th class="py-2 px-4 border-b text-center">Mg/Kg/Day</th>
                            <th class="py-2 px-4 border-b text-center">Dose</th>
                            <th class="py-2 px-4 border-b text-center">Frequency</th>
                            <th class="py-2 px-4 border-b text-center">Duration</th>
                            <th class="py-2 px-4 border-b text-center">Start</th>
                            <th class="py-2 px-4 border-b text-center">End</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        mysqli_data_seek($result, 0); // Reset pointer for reuse
                        while ($illness = mysqli_fetch_assoc($result)) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b text-center"><?= $illness['date'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['illness_treatment'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['medication'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['mg_kg_day'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['dose'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['frequency'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['duration'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['start_date'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $illness['end_date'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
