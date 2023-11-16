<?php
// Start the session
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION["email"])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
    $emailToDelete = $_POST['emailToDelete'];

    // Database connection parameters
    $dbHost = "localhost:3306"; // Change this if your MySQL server is on a different host
    $dbUsername = "root"; // Replace with your MySQL username
    $dbPassword = ""; // Replace with your MySQL password
    $dbName = "lgdb"; // Name of the database

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare a delete query
    $query = "DELETE FROM details WHERE EmailID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emailToDelete);

    // Execute the delete query
    if ($stmt->execute()) {
        echo "Trainee with email: $emailToDelete has been deleted successfully.";
    } else {
        echo "Error deleting trainee: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Trainee</title>
    <style>
        /* Add your CSS styles here for the page layout */
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Delete Trainee</h1>
    </div>
    <div class="icons">
        <a href="dashboard.html">Home</a>
        <a href="logout.html">Logout</a>
    </div>
</header>

<div class="container">
    <h2>Delete Trainee</h2>
    <form method="post">
        <label for="emailToDelete">Enter Trainee's Email to Delete:</label>
        <input type="email" id="emailToDelete" name="emailToDelete" required>
        <button type="submit">Delete Trainee</button>
    </form>
</div>
</body>
</html>
