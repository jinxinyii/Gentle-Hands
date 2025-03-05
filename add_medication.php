<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_group = $_POST['patient_group'];
    $patient_name = $_POST['patient_name'];
    $prescribed_by = $_POST['prescribed_by'];
    $medicine_name = $_POST['medicine_name'];
    $strength = $_POST['strength'];
    $mg_kg_day = $_POST['mg_kg_day'];
    $dose = $_POST['dose'];
    $frequency = $_POST['frequency'];
    $duration = $_POST['duration'];
    $day = $_POST['day'];
    $week = $_POST['week'];
    $month = $_POST['month'];

    $sql = "INSERT INTO medications (patient_group, patient_name, prescribed_by, medicine_name, strength, mg_kg_day, dose, frequency, duration, day, week, month)
            VALUES ('$patient_group', '$patient_name', '$prescribed_by', '$medicine_name', '$strength', '$mg_kg_day', '$dose', '$frequency', '$duration', '$day', '$week', '$month')";

    if (mysqli_query($conn, $sql)) {
        echo "Medication added successfully! <a href='admin_dashboard.php'>View Medications</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Medication</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; }
        .container { width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px gray; margin-top: 50px; }
        input, select { width: 100%; padding: 8px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px; border: none; width: 100%; cursor: pointer; border-radius: 4px; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Medication</h2>
        <form method="POST">
            <input type="text" name="patient_group" placeholder="Group" required><br>
            <input type="text" name="patient_name" placeholder="Patient Name" required><br>
            <input type="text" name="prescribed_by" placeholder="Prescribed by" required><br>
            <input type="text" name="medicine_name" placeholder="Medicine Name" required><br>
            <input type="text" name="strength" placeholder="Strength" required><br>
            <input type="text" name="mg_kg_day" placeholder="Mg/Kg/Day" required><br>
            <input type="text" name="dose" placeholder="Dose" required><br>
            <input type="text" name="frequency" placeholder="Frequency" required><br>
            <input type="text" name="duration" placeholder="Duration" required><br>
            <input type="text" name="day" placeholder="Day"><br>
            <input type="text" name="week" placeholder="Week"><br>
            <input type="text" name="month" placeholder="Month"><br>
            <button type="submit">Add Medication</button>
        </form>
    </div>
</body>
</html>
