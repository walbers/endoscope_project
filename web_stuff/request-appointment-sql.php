<?php
  session_start();
  require_once "config.php";

  //echo print_r($_POST);

  $doctor = $_POST["doctor"];
  $date = $_POST["date"];
  $user = $_POST["user"];

  echo '<form method="post" action="request-appointment.php">';
  $sql = "INSERT INTO meetings (doctor, patient, meeting_date, meeting_status, details) VALUES (\"$doctor\", \"$user\", \"$date\", 0, \"none\");";
  if ($result = $conn->query($sql)) {
    echo '<input type="hidden" name="status" value="success">';
  } else {
    echo '<input type="hidden" name="status" value="failure">';
  }
  echo '</form>';

  echo '<script>window.onload = function(){document.forms[0].submit();} </script>';
?>
