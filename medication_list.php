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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medication List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            <h2 class="text-2xl font-bold text-center mb-4">Medication List</h2>

            <div class="flex justify-between mb-4">
                <a href="admin_dashboard.php" class="bg-red-500 text-white py-2 px-4 rounded hover:opacity-80">Back to Dashboard</a>
                <a href="add_medication.php" class="bg-green-500 text-white py-2 px-4 rounded hover:opacity-80">Add Medication</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Patient Name</th>
                            <th class="py-2 px-4 border-b text-center">Prescribed by</th>
                            <th class="py-2 px-4 border-b text-center">Medicine Name</th>
                            <th class="py-2 px-4 border-b text-center">Strength</th>
                            <th class="py-2 px-4 border-b text-center">Mg/Kg/Day</th>
                            <th class="py-2 px-4 border-b text-center">Dose</th>
                            <th class="py-2 px-4 border-b text-center">Frequency</th>
                            <th class="py-2 px-4 border-b text-center">Duration</th>
                            <th class="py-2 px-4 border-b text-center">Day</th>
                            <th class="py-2 px-4 border-b text-center">Week</th>
                            <th class="py-2 px-4 border-b text-center">Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($medication = mysqli_fetch_assoc($medication_result)) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b text-center"><?= $medication['patient_name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['prescribed_by'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['medicine_name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['strength'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['mg_kg_day'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['dose'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['frequency'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['duration'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['day'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['week'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $medication['month'] ?></td>
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