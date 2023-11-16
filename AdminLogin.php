<?php
session_start();

// Database connection parameters
$dbHost = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$dbName = "lgdb";

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate and sanitize the email
    $email = mysqli_real_escape_string($conn, $email);

    // Query the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if a user with the provided email exists
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        // Verify the password
        if (password_verify($password, $stored_password)) {
            // Password is correct, user is authenticated
            $_SESSION["email"] = $email;
            header("location: AdminDashboard.html");
            exit();
        } else {
            echo '<script>alert("Invalid User/Password");</script>';
        }
    } else {
        // No user found with the provided email
        echo '<script>alert("User not found");</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
