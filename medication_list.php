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
                <a href="#" class="bg-green-500 text-white py-2 px-4 rounded hover:opacity-80" onclick="document.getElementById('addMedicationModal').style.display='block'">Add Medication</a>
            </div>

            <div id="addMedicationModal" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
                        <span class="absolute top-0 right-0 p-4 cursor-pointer" onclick="document.getElementById('addMedicationModal').style.display='none'">&times;</span>
                        <h2 class="text-2xl font-bold text-center mb-4">Add Medication</h2>
                        <form method="POST" action="add_medication.php" class="space-y-4">
                            <input type="text" name="patient_group" placeholder="Group" required pattern="[A-Za-z\s]+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="patient_name" placeholder="Patient Name" required pattern="[A-Za-z\s]+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="prescribed_by" placeholder="Prescribed by" required pattern="[A-Za-z\s]+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="medicine_name" placeholder="Medicine Name" required pattern="[A-Za-z\s]+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="strength" placeholder="Strength" required pattern="\d+(\.\d{1,2})?" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="mg_kg_day" placeholder="Mg/Kg/Day" required pattern="\d+(\.\d{1,2})?" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="dose" placeholder="Dose" required pattern="\d+(\.\d{1,2})?" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="frequency" placeholder="Frequency" required pattern="\d+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="duration" placeholder="Duration" required pattern="\d+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="day" placeholder="Day" pattern="\d+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="week" placeholder="Week" pattern="\d+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <input type="text" name="month" placeholder="Month" pattern="\d+" class="w-full p-2 border border-gray-300 rounded"><br>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:opacity-80 w-full">Add Medication</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-2 border-b text-center">Patient Name</th>
                            <th class="py-2 px-2 border-b text-center">Prescribed by</th>
                            <th class="py-2 px-2 border-b text-center">Medicine Name</th>
                            <th class="py-2 px-2 border-b text-center">Strength</th>
                            <th class="py-2 px-2 border-b text-center">Mg/Kg/Day</th>
                            <th class="py-2 px-2 border-b text-center">Dose</th>
                            <th class="py-2 px-2 border-b text-center">Frequency</th>
                            <th class="py-2 px-2 border-b text-center">Duration</th>
                            <th class="py-2 px-2 border-b text-center">Day</th>
                            <th class="py-2 px-2 border-b text-center">Week</th>
                            <th class="py-2 px-2 border-b text-center">Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($medication = mysqli_fetch_assoc($medication_result)) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-2 border-b text-center"><?= $medication['patient_name'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['prescribed_by'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['medicine_name'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['strength'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['mg_kg_day'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['dose'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['frequency'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['duration'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['day'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['week'] ?></td>
                                <td class="py-2 px-2 border-b text-center"><?= $medication['month'] ?></td>
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