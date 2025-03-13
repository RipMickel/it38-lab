<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:./index.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "it38c-2"); // Update with your database credentials

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Record attendance using SQL logic
$user_id = $_SESSION["id"]; // Assuming user ID is stored in session
$date = date("Y-m-d"); // Format the current date
$status = 'Present'; // Default status

// Insert attendance record
$sql = "INSERT INTO tbl_Attendance (user_id, attendance_date, status) VALUES ($user_id, '$date', '$status')";

$conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="../logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>

</html>
