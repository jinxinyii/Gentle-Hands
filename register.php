<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_admission = $_POST['date_of_admission'];
    $age_of_admission = $_POST['age_of_admission'];
    $current_age = $_POST['current_age'];
    $children_category = $_POST['children_category'];

    // Backend Regex Validation for First & Last Name
    if (!preg_match("/^[A-Za-z\s]+$/", $first_name) || !preg_match("/^[A-Za-z\s]+$/", $last_name)) {
        echo "<script>alert('Error: Names can only contain letters and spaces!'); window.history.back();</script>";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, sex, date_of_birth, date_of_admission, age_of_admission, current_age, children_category) 
            VALUES ('$first_name', '$last_name', '$sex', '$date_of_birth', '$date_of_admission', '$age_of_admission', '$current_age', '$children_category')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful! <a href='admin_dashboard.php'>View Records</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px gray;
            margin-top: 50px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function calculateAges() {
            let birthDate = new Date(document.getElementById("date_of_birth").value);
            let admissionDate = new Date(document.getElementById("date_of_admission").value);
            let today = new Date();

            if (!isNaN(birthDate) && !isNaN(admissionDate)) {
                let ageAtAdmission = admissionDate.getFullYear() - birthDate.getFullYear();
                let currentAge = today.getFullYear() - birthDate.getFullYear();

                document.getElementById("age_of_admission").value = ageAtAdmission;
                document.getElementById("current_age").value = currentAge;
            }
        }

        function validateLetters(input) {
            let regex = /^[A-Za-z\s]+$/;
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^A-Za-z\s]/g, '');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="first_name" placeholder="First Name" required oninput="validateLetters(this)"><br>
            <input type="text" name="last_name" placeholder="Last Name" required oninput="validateLetters(this)"><br>
            <select name="sex" required>
                <option value="">Select Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br>
            
            <label>Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required onchange="calculateAges()"><br>

            <label>Date of Admission:</label>
            <input type="date" id="date_of_admission" name="date_of_admission" required onchange="calculateAges()"><br>

            <label>Age at Admission:</label>
            <input type="text" id="age_of_admission" name="age_of_admission" readonly><br>

            <label>Current Age:</label>
            <input type="text" id="current_age" name="current_age" readonly><br>

            <label>Children Category:</label>
            <select name="children_category" required>
                <option value="">Select Category</option>
                <option value="Upstairs">Upstairs</option>
                <option value="Nursery 1">Nursery 1</option>
                <option value="Nursery 2">Nursery 2</option>
                <option value="Toddlers">Toddlers</option>
                <option value="Pre-School">Pre-School</option>
                <option value="Big Boys">Big Boys</option>
                <option value="Bigger Boys">Bigger Boys</option>
                <option value="Big Girls">Big Girls</option>
                <option value="Bigger Girls">Bigger Girls</option>
                <option value="Unassigned">Unassigned</option>
            </select><br>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
