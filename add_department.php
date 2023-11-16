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
    $tslDepartment = $_POST['tslDepartment'];
    $tslGuide = $_POST['tslGuide'];
    $projectTitle = $_POST['projectTitle'];

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

    // Prepare an insert query
    $query = "INSERT INTO department (TSLDepartment, TSLGuide, ProjectTitle) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $tslDepartment, $tslGuide, $projectTitle);

    // Execute the insert query
    if ($stmt->execute()) {
        $successMessage = "Department details added successfully.";
    } else {
        $errorMessage = "Error adding department details: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #4CAF50;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border-radius: 10px 10px 0 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: white;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        header a:hover {
            background-color: #2980b9;
        }

        h2 {
            font-size: 24px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Add Department</h1>
    </div>
    <div class="icons">
        <a href="dashboard.html">Home</a>
        <a href="logout.html">Logout</a>
    </div>
</header>

<div class="container">
    
    <form method="post">
        <label for="tslDepartment">TSL Department:</label>
        <input type="text" id="tslDepartment" name="tslDepartment" required><br>

        <label for="tslGuide">TSL Guide:</label>
        <input type="text" id="tslGuide" name="tslGuide" required><br>

        <label for="projectTitle">Project Title:</label>
        <input type="text" id="projectTitle" name="projectTitle" required><br>

        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    } elseif (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>
</div>
</body>
</html>
