<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" type="text/css" href="registration.css">
</head>
<body>
  <header>
    <div class="container">
      <h1>Registration Form</h1>
    </div>
    <div class="icons">
        <a href="dashboard.html">Home</a>
        <a href="logout.html">Logout</a>
    </div>
  </header>

  <div class="container">
    <?php
   $dbhost="localhost:3306";
   $dbuser="root";
   $dbpss="";
   $dbname="lgdb";
   
   $connection =new mysqli($dbhost,$dbuser,$dbpss,$dbname);
   
   if($connection->connect_error){
       die("Connection error:".$connection->connect_error);
   
   }
   
   if( $_SERVER["REQUEST_METHOD"]=="POST")
   {
       $name=$_POST["name"];
       $email=$_POST["email"];
       $checkSql = "SELECT * FROM details WHERE EmailID = ?";
       $checkStmt = $connection->prepare($checkSql);
       $checkStmt->bind_param("s", $email);
       $checkStmt->execute();
       $checkStmt->store_result();
   
       if ($checkStmt->num_rows > 0) {
           echo '<script>alert("Email already exists. Please choose a different email.");</script>';
       } else {

       $contactNo=$_POST["contact"];
       $collegeName=$_POST["college"];
       $course=$_POST["course"];
       $semester=$_POST["semester"];    
       $projectTitle=$_POST["project"];
       $tslDepartment=$_POST["department"];
       $peojectGuide=$_POST["guide"];
   
   
   $sql="insert into details (Name,EmailID,ContactNo,CollegeName,Course,Semester,ProjectTitle,TSLDepartment,ProjectGuide) values (?,?,?,?,?,?,?,?,?)";
   
   $stmt = $connection->prepare($sql);
   $stmt->bind_param("sssssssss", $name,$email,$contactNo,$collegeName,$course,$semester,$projectTitle,$tslDepartment,$peojectGuide);
   
   if ($stmt->execute()) {
       echo '<script>alert("Profile Completed!");</script>';
       header("refresh: 0.5; url=dashboard.html
       "); // Redirect after a 0-second delay
   
   } else {
       echo "Error: " . $stmt->error;
   }
   
   $stmt->close();
  }
   }

   $connection->close();
   ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="email">Email ID:</label>
      <input type="email" id="email" name="email" required><br>

      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br>

      <label for="contact">Contact:</label>
      <input type="tel" id="contact" name="contact" required><br>

      <label for="college">College Name:</label>
      <input type="text" id="college" name="college" required><br>

      <label for="course">Course:</label>
      <input type="text" id="course" name="course" required><br>

      <label for="semester">Semester:</label>
      <input type="text" id="semester" name="semester" required><br>

      <label for="project">Project:</label>
      <input type="text" id="project" name="project" required><br>

      <label for="department">TSL Department:</label>
      <input type="text" id="department" name="department" required><br>

      <label for="guide">TSL Guide:</label>
      <input type="text" id="guide" name="guide" required><br>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
