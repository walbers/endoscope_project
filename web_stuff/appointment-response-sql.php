<?php
  session_start();
  require_once "config.php";

  $id = $_POST["id"];
  $reponse = $_POST["response"];
  $status;
  if (strcmp($reponse, "accept") == 0) {
    $status = 1;
  } else {
    $status = 2;
  } 

  echo '<form method="post" action="welcome-doctor.php">';
  //$sql = "INSERT INTO meetings (doctor, patient, meeting_date, meeting_status, details) VALUES (\"$doctor\", \"$user\", \"$date\", 0, \"none\");";
  
  $sql = "UPDATE meetings SET meeting_status=".$status." WHERE id=".$id.";";
  if ($result = $conn->query($sql)) {
    echo '<input type="hidden" name="status" value="success">';
  } else {
    echo '<input type="hidden" name="status" value="failure">';
  }
  echo '</form>';

  echo '<script>window.onload = function(){document.forms[0].submit();} </script>';

?>

