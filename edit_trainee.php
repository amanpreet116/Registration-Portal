<?php
session_start(); // Start the session

// Check if the email parameter is set
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Database connection parameters
    $dbHost = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "lgdb";

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Query the database to retrieve user information based on email
    $sql = "SELECT * FROM details WHERE EmailID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, fetch and display their information for editing
        $user = $result->fetch_assoc();
    } else {
        // User not found
        echo "User not found.";
        // You can handle this case, such as showing a message or redirecting to another page.
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Trainee Details</title>
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
      margin-top: 20px;
      font-size: 24px;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"] {
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
      <h1>Edit Trainee Details</h1>
    </div>
    <div class="icons">
      <a href="AdminDashboard.html">Home</a>
      <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <h2>Edit Trainee Details</h2>
    <form method="post" action="update_trainee.php">
      <input type="hidden" name="email" value="<?php echo $email; ?>">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $user['Name']; ?>"  >
      
      <label for="contact">Contact Number:</label>
      <input type="text" id="contact" name="contact" value="<?php echo $user['ContactNo']; ?>" >
      
      <label for="college">College Name:</label>
      <input type="text" id="college" name="college" value="<?php echo $user['CollegeName']; ?>" >
      
      <label for="course">Course:</label>
      <input type="text" id="course" name="course" value="<?php echo $user['Course']; ?>" >
      
      <label for="semester">Semester:</label>
      <input type="text" id="semester" name="semester" value="<?php echo $user['Semester']; ?>" >
      
      <label for="project">Project Title:</label>
      <input type="text" id="project" name="project" value="<?php echo $user['ProjectTitle']; ?>" >
      
      <label for="tslDepartment">TSL Department:</label>
      <input type="text" id="tslDepartment" name="tslDepartment" value="<?php echo $user['TSLDepartment']; ?>" required>
      
      <label for="projectGuide">Project Guide:</label>
      <input type="text" id="projectGuide" name="projectGuide" value="<?php echo $user['ProjectGuide']; ?>" required>

      <button type="submit" name="updateTrainee">Update Trainee</button>
    </form>
  </div>
</body>
</html>
