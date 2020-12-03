<?php
echo print_r($_POST);

  $doctor = $_POST["doctor"];
  $date = $_POST["date"];
  $user = $_POST["user"];

  $sql = "INSERT INTO meetings VALUES (\"$doctor\", \"$user\", \"$date\", 0, \"none\";";

  if ($result = $conn->query($sql)) {
    $result->free();
  }

  header("Location: https://virtualcheckup.walbers.com/request-appointment.php");
  die();
?>
