<?php
// Initialize the session
session_start();
require_once "config.php";

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="index.css">
    <!--<style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>-->
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
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
	<a href="request-appointment.php" class="btn btn-success">Request Appointment</a>
        <a class="btn btn-primary" href="https://www.fitbit.com/oauth2/authorize?response_type=token&client_id=22BTHZ&redirect_uri=https%3A%2F%2Fvirtualcheckup.walbers.com%2Fcallback.php&scope=activity%20heartrate%20location%20nutrition%20profile%20settings%20sleep%20social%20weight&expires_in=604800">
          Fitbit Dashboard
	</a>
        <a class="btn btn-dark" href="https://blooming-wave-86200.herokuapp.com/">Video Chat</a> 
    </p>
    <h2>Appointments</h2>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>patient</th>
        <th>date</th>
        <th>details</th>
	<th>status</th>
        <th>video chat room name</th>
      </tr>
    </thead>
    <tbody>
      <?php
    
    // Get list of registered patients already
    $user = $_SESSION["username"];

    $query = "SELECT * FROM meetings WHERE patient=\"$user\";";
    if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $doctor = $row["doctor"];
        $meeting_date = $row["meeting_date"];
        $meeting_status = $row["meeting_status"];
        $details = $row["details"];
        if ($meeting_status == 0) {
          echo '<tr>
                 <td>'.$doctor.'</td>  
                 <td>'.$meeting_date.'</td>  
                 <td>'.$details.'</td>  
		 <td>Pending</td>  
                 <td>-</td>
               </tr>';
        }
        else if ($meeting_status == 1) {
          echo '<tr>
                 <td>'.$doctor.'</td>  
                 <td>'.$meeting_date.'</td>  
                 <td>'.$details.'</td>  
                 <td>Accepted</td>  
                 <td>'.$id.'</td>
               </tr>';
        }
        else {
          echo '<tr>
                 <td>'.$doctor.'</td>  
                 <td>'.$meeting_date.'</td>  
                 <td>'.$details.'</td>  
                 <td>Denied</td>  
                 <td>-</td>
               </tr>';
        }
      }
      $result->free();
    } else {
      echo "failure";
    }

    ?>

</body>
</html>
