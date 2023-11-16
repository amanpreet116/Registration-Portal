<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }

    a {
      display: block;
      margin: 10px 0;
      font-size: 18px;
      text-decoration: none;
      color: #333;
    }
  </style>
</head>
<body>
<header>
    <div class="container">
      <h1> Reports</h1>
    </div>
    <div class="icons">
        <a href="AdminDashboard.html">Home</a>
        <a href="logout.html">Logout</a>
    </div>
  </header>


    <?php
 session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>alert("Please Log in first");</script>';
    header("refresh: 0.0; url=login.php");
    exit();
}
    // Create a connection to the XAMPP MySQL database
    $servername = "localhost";
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password is empty
    $database = "lgdb"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $database);
    $fd="Not Submitted";
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the SELECT query
    $sql = "SELECT * FROM details"; // Replace with your table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='dataTable' class='display' style='width:100%'>";
        echo "<thead><tr><th>Name</th><th>EmailID</th><th>ContactNo</th><th>CollegeName</th><th>Course</th><th>Sem</th><th>ProjectTitle</th><th>TSLDepartment</th><th>ProjectGuide</th><th>Feedback?</th><th>ExitDate</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            $sql1 = "SELECT * FROM feedback WHERE email = '" . $row['EmailID'] . "'";

            $result1 = $conn->query($sql1);
            $com="NA";
            if ($result1->num_rows > 0) 
            {$fd="Submitted";
            $row1=$result1->fetch_assoc();
            // $com=$row1["subTime"];
            }


            echo "<tr>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["EmailID"] . "</td>";
            echo "<td>" . $row["ContactNo"] . "</td>";
            echo "<td>" . $row["CollegeName"] . "</td>";
            echo "<td>" . $row["Course"] . "</td>";
            echo "<td>" . $row["Semester"] . "</td>";
            echo "<td>" . $row["ProjectTitle"] . "</td>";
            echo "<td>" . $row["TSLDepartment"] . "</td>";
            echo "<td>" . $row["ProjectGuide"] . "</td>";
            // echo "<td>" . $row["joinDate"] . "</td>";
            echo "<td>" . $fd . "</td>";
            echo "<td>" . $com . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No records found";
    }

    // Close the connection
    $conn->close();
    ?>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>


</body>
</html>