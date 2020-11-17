<?php
  session_start();
  require_once "config.php";
/*

  function fillTable() {

    $query = "SELECT * FROM patients";


    if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        $field1name = $row["username"];
	$field2name = $row["first_name"];
	$field3name = $row["last_name"];

	echo '<tr> 
		  <th scope="row"></th>
		  <td>'.$field2name.'</td>
		  <td>'.$field3name.'</td>
                  <td>'.$field1name.'</td> 
              </tr>';
      }
      $result->free();
    }
  }
 */
?>


<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>

<body>

  <h1>Hi 1, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
  <!-- <p>test <?php //echo htmlspecialchars($field1name); ?></p> -->

  <table class="table table-striped">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
	<th>Username</th>
        <th>Sign Up</th>
      </tr>
    </thead>
    <tbody>
      <?php 

    // Get list of registered patients already
    $sql = "SELECT patient FROM doctor_client WHERE doctor=?";
    $already_registered = [];
    
    if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
      
      if($result = mysqli_stmt_execute($stmt)) {
        while($row = $result->fetch_assoc()) {
          $already_registered[$row["patient"]] = 1;
	}
        $result->free();
      }
    }
 

    $query = "SELECT * FROM patients";

    if ($result = $conn->query($query)) {
      while ($row = $result->fetch_assoc()) {
        $field1name = $row["username"];
	$field2name = $row["first_name"];
	$field3name = $row["last_name"];

        if (isset($already_registered[$field1name])) {
	  echo '<tr>	
		  <td>'.$field2name.'</td>
		  <td>'.$field3name.'</td>
		  <td>'.$field1name.'</td>
		  <td>Already signed up!</td>
	      </tr>';
        } else {
	  echo '<tr>	
		  <td>'.$field2name.'</td>
		  <td>'.$field3name.'</td>
		  <td>'.$field1name.'</td>
		  <td>
		    <form method="post">
		      <input type="submit" name="Sign up" class="button" value="'.$field1name.'" />
                    </form>
		  </td>
		</tr>';
	}
      }
      $result->free();
    }
      ?>
    </tbody>
  </table>


</body>
</html>

