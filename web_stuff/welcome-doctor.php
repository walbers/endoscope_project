<?php
// Initialize the session
session_start();
require_once "config.php";
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

<link rel="stylesheet" type="text/css" href="index.css">


</head>
<body>
  <nav class="navbar navbar-expand-md">
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main-navigation">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
  </nav>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <a href="patient-list.php" class="btn btn-success">Patient List</a>
    <p>
        <a href="reset-password-doctor.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <h2>Appointments</h2>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>doctor</th>
        <th>date</th>
        <th>details</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <?php

    // Get list of registered patients already
    $user = $_SESSION["username"];

    $query = "SELECT * FROM meetings WHERE doctor=\"$user\";";
    if (isset($_POST["status"])) {
      echo '<script>alert("'.$_POST["status"].'");</script>';
    }
    if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
	$id = $row["id"]; 
	$patient = $row["patient"];
	$meeting_date = $row["meeting_date"];
	$meeting_status = $row["meeting_status"];
	$details = $row["details"];
	if ($meeting_status == 0) {
	  echo '<tr>
	    	 <td>'.$patient.'</td>  
	    	 <td>'.$meeting_date.'</td>  
	    	 <td>'.$details.'</td>  
		 <td>
                   <form action="appointment-response-sql.php" method="post">
		     <input type="hidden" name="id" value="'.$id.'">
                     <input type="submit" name="response" value="accept">
                     <input type="submit" name="response" value="reject">
                   </form>

                 </td>  
	       </tr>';  	
	}
	else if ($meeting_status == 1) {
	  echo '<tr>
	    	 <td>'.$patient.'</td>  
	    	 <td>'.$meeting_date.'</td>  
	    	 <td>'.$details.'</td>  
	    	 <td>Accepted</td>  
	       </tr>';  	
	}
	else {
	  echo '<tr>
	    	 <td>'.$patient.'</td>  
	    	 <td>'.$meeting_date.'</td>  
	    	 <td>'.$details.'</td>  
	    	 <td>Denied</td>  
	       </tr>';  		
	}
      }
      $result->free();
    } else {
      echo "failure";
    }
 
    ?>
    </tbody>
</body>
</html>
