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
        echo "<script>alert('Medication added successfully!'); window.location.href='medication_list.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>