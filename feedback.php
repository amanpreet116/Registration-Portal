<?php
session_start();

// Check if the user is logged in, or redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$dbHost = "localhost"; // Change this if your MySQL server is on a different host
$dbUsername = "root"; // Your MySQL username
$dbPassword = ""; // Your MySQL password (default for XAMPP)
$dbName = "lgdb"; // The name of your database

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_SESSION["email"];
$name = "";

$query = "SELECT Name FROM details WHERE EmailID = '$email'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["Name"];
    } else {
        // Handle the case where no rows were returned, e.g., set a default name
        $name = "User"; // Change this to the default name you prefer
    }
}

$feedbackMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["contact"]) && isset($_POST["message"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $message = $_POST["message"];

        // Save the feedback data to the database (you should have your own database structure and query here)
        $query = "INSERT INTO feedback (Name, Email, Contact, Message) VALUES ('$name', '$email', '$contact', '$message')";
        
        if (mysqli_query($conn, $query)) {
            $feedbackMessage = "Feedback submitted successfully.";
        } else {
            $feedbackMessage = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .navbar {
            background-color: #4CAF50;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .feedback-form {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .feedback-form input[type="text"],
        .feedback-form input[type="email"],
        .feedback-form input[type="tel"],
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .feedback-form textarea {
            height: 150px;
        }

        .feedback-form button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .feedback-form button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.html">Home</a>
        <span>Feedback Form </span>
        <a href="logout.html">Logout</a>
    </div>
    <div class="feedback-form">
       <h4>Give a feedback for your experience </h4>
        <?php
        if (!empty($feedbackMessage)) {
            echo "<p>$feedbackMessage</p>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required readonly>

            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
