<?php
  session_start();
  require_once "config.php";
?>


<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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


  <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to our site.</h1>
  <a href="welcome.php" class="btn btn-success">Home</a>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Doctor</th>
	<th>Appointment Date</th>
	<th>Request Appointment</th>
      </tr>
    </thead>
    <tbody>
      <?php 

    $user = $_SESSION["username"];
    $sql = "SELECT doctor FROM doctor_client WHERE patient=\"$user\";";
    if (isset($_POST["status"])) {
      echo '<script>alert("'.$_POST["status"].'");</script>';
    } 


    $date = date("Y-m-d h:i"); 
    if ($result = $conn->query($sql)) {
      while ($row = $result->fetch_assoc()) {
	$doctor = $row["doctor"];
	echo '<tr>	
		  <form action="request-appointment-sql.php" method="post">
		    <td>'.$doctor.'</td>
		    <input type="hidden" name="doctor" value="'.$doctor.'">
		    <input type="hidden" name="user" value="'.$user.'">
		    <td>
		      <input type="datetime-local" name="date" value="'.$date.'"/>
		    </td>
		    <td>	
		      <input type="submit" name="Request" class="button" value="Request!"/>
		    </td>
                  </form>
		</tr>';
	
      }
      $result->free();
    }
    ?>
    </tbody>
  </table>


</body>
</html>

