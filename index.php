<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];
    if (!preg_match('/^[a-zA-Z0-9_]{5,20}$/', $username)) {
        echo "Invalid username format!";
    } elseif (!preg_match('/^[a-zA-Z0-9@#\-_$%^&+=§!\?]{6,20}$/', $password)) {
        echo "Invalid password format!";
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
        } else {
            echo "Invalid login!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="container max-w-sm bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <form method="POST">
            <input type="text" name="admin_username" placeholder="Admin Username" required class="w-full p-2 mb-4 border border-gray-300 rounded"><br>
            <input type="password" name="admin_password" placeholder="Password" required class="w-full p-2 mb-4 border border-gray-300 rounded"><br>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-700">Login</button>
        </form>
    </div>
</body>
</html>