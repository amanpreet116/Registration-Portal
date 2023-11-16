<?php
session_start(); // Start the session

// Check if the "Find Trainee" button is clicked
if (isset($_GET['findTrainee'])) {
    // Redirect to the edit_trainee.php page with the email parameter
    $email = $_GET['email'];
    header("Location: edit_trainee.php?email=$email");
    exit();
}

// Check if the "Delete Trainee" button is clicked
if (isset($_GET['deleteTrainee'])) {
    // Redirect to the delete_trainee.php page with the email parameter
    $email = $_GET['email'];
    header("Location: delete_trainee.php?email=$email");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Find Trainee</title>
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

    input[type="email"] {
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

    button[type="submit"]:last-child {
      background-color: #f44336;
    }

    button[type="submit"]:last-child:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>Find Trainee</h1>
    </div>
    <div class="icons">
      <a href="AdminDashboard.html">Home</a>
      <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <h2>Find Trainee</h2>
    <form method="get">
      <label for="email">Enter Trainee's Email:</label>
      <input type="email" id="email" name="email" >
      <button type="submit" name="findTrainee">Find Trainee</button>
      <br>
      <label for="email">Enter Trainee's Email:</label>
      <input type="email" id="email" name="email" >
      <button type="submit" name="deleteTrainee">Delete Trainee</button>
    </form>
  </div>
</body>
</html>
