<?php
// Establish a database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "amanpreet";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone_number"];
$college = $_POST["college_name"];
$course = $_POST["course"];

$sql = "INSERT INTO form_data (name, email, phone, college, course)
        VALUES ('$name', '$email', '$phone', '$college', '$course')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
