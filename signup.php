<?php
// Database connection parameters
$dbHost = "localhost:3306"; // Change this if your MySQL server is on a different host
$dbUsername = "root"; // Replace with your MySQL username
$dbPassword = ""; // Replace with your MySQL password
$dbName = "lgdb"; // Name of the database

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Check if the email already exists
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo '<script>alert("Email already exists. Please choose a different email.");</script>';
        echo '<script>window.location = "signup.html";</script>';
    } else {
        // Insert user data into the database
        $insert_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ss", $email, $password);

        if ($insert_stmt->execute()) {
            echo '<script>alert("Sign-up successful!");</script>';
            header("refresh: 0; url=login.html"); // Redirect after a 0-second delay
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $check_stmt->close();
}

// Close the database connection
$conn->close();
?>
