<!DOCTYPE html>
<html>
<head>
  <title>Update Trainee Details</title>
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

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      margin-bottom: 10px;
    }

    strong {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Update Trainee Details</h1>
    </div>
    <div class="icons">
      <a href="AdminDashboard.html">Home</a>
      <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <?php
    session_start();

    // Database connection parameters
    $dbHost = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "lgdb";

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['updateTrainee'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $college = $_POST['college'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $project = $_POST['project'];
        $tslDepartment = $_POST['tslDepartment'];
        $projectGuide = $_POST['projectGuide'];

        // Update the trainee details in the database
        $sqlUpdate = "UPDATE details SET Name=?, ContactNo=?, CollegeName=?, Course=?, Semester=?, ProjectTitle=?, TSLDepartment=?, ProjectGuide=? WHERE EmailID=?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("sssssssss", $name, $contact, $college, $course, $semester, $project, $tslDepartment, $projectGuide, $email);
        
        if ($stmtUpdate->execute()) {
            echo "<h2>Trainee Details Updated Successfully</h2>";
            echo "<ul>";
            echo "<li><strong>Email:</strong>  $email </li>";
            echo "<li><strong>Name:</strong> $name </li>";
            echo "<li><strong>Contact:</strong> $contact </li>";
            echo "<li><strong>College Name:</strong> $college </li>";
            echo "<li><strong>Course:</strong> $course </li>";
            echo "<li><strong>Semester:</strong> $semester </li>";
            echo "<li><strong>Project:</strong> $project </li>";
            echo "<li><strong>TSL Department:</strong> $tslDepartment </li>";
            echo "<li><strong>TSL Guide:</strong> $projectGuide </li>";
            echo "</ul>";
        } else {
            echo "Error updating trainee details: " . $stmtUpdate->error;
        }

        // Close the prepared statement
        $stmtUpdate->close();
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>
</body>
</html>
