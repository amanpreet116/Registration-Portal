<!DOCTYPE html>
<html>
<head>
  <title>Profile Details</title>
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
      <h1>Profile Details</h1>
    </div>
    <div class="icons">
      <a href="dashboard.html">Home</a>
      <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <?php
    session_start();
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

      // Get the user's email (you can use the session or any other method you prefer)
      $email = $_SESSION["email"];

      // Query to retrieve user information from the database
      $query = "SELECT * FROM details WHERE EmailID = '$email'";
      $result = mysqli_query($conn, $query);
      
      if ($result) {
        // Check if there is data for this user
        if (mysqli_num_rows($result) > 0) {
          $userData = mysqli_fetch_assoc($result);
          echo "<h2>User Information</h2>";
          echo "<ul>";
          echo "<li><strong>Email:</strong>  $email </li>";
          echo "<li><strong>Name:</strong> " . $userData['Name'] . "</li>";
          echo "<li><strong>Contact:</strong> " . $userData['ContactNo'] . "</li>";
          echo "<li><strong>College Name:</strong> " . $userData['CollegeName'] . "</li>";
          echo "<li><strong>Course:</strong> " . $userData['Course'] . "</li>";
          echo "<li><strong>Semester:</strong> " . $userData['Semester'] . "</li>";
          echo "<li><strong>Project:</strong> " . $userData['ProjectTitle'] . "</li>";
          echo "<li><strong>TSL Department:</strong> " . $userData['TSLDepartment'] . "</li>";
          echo "<li><strong>TSL Guide:</strong> " . $userData['ProjectGuide'] . "</li>";
          echo "</ul>";
        } else {
          echo "No data found.";
        }
      } else {
        echo "Query failed: " . mysqli_error($conn);
      }

      // Close the database connection
      mysqli_close($conn);
    ?>
  </div>
</body>
</html>
