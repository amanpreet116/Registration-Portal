<!DOCTYPE html>
<html>
<head>
  <title>Update Trainee Profile</title>
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
      margin-top: 15px;
    }

    ul {
      list-style: none;
      padding: 10px;
      margin-top: 15px;
    }

    li {
      margin-bottom: 30px;
      margin-top: 15px;
    }

    strong {
      font-weight: bold;
    }

    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Updated Trainee Profile</h1>
    </div>
    <div class="icons">
      <a href="AdminDashboard.html">Home</a>
      <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <?php
    // Retrieve the updated information from the form submitted in edit_trainee.php
    $updatedName = $_POST['name'];
    $updatedContact = $_POST['contact'];
    $updatedCollege = $_POST['college'];
    $updatedCourse = $_POST['course'];
    $updatedSemester = $_POST['semester'];
    $updatedProject = $_POST['project'];
    $updatedDepartment = $_POST['department'];
    $updatedGuide = $_POST['guide'];

    echo "<h2>Updated Trainee Information</h2>";
    echo "<ul>";
    echo "<li><strong>Name:</strong> $updatedName</li>";
    echo "<li><strong>Contact:</strong> $updatedContact</li>";
    echo "<li><strong>College Name:</strong> $updatedCollege</li>";
    echo "<li><strong>Course:</strong> $updatedCourse</li>";
    echo "<li><strong>Semester:</strong> $updatedSemester</li>";
    echo "<li><strong>Project:</strong> $updatedProject</li>";
    echo "<li><strong>TSL Department:</strong> $updatedDepartment</li>";
    echo "<li><strong>TSL Guide:</strong> $updatedGuide</li>";
    echo "</ul>";
    ?>
  </div>
</body>
</html>
