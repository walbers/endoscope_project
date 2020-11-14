<?php

ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);

$servername = "ls-4f811ca042ed9a6dd6102f5a9b1fce11f25c86c7.c9dvuwfsdxbr.us-east-2.rds.amazonaws.com";
$username = "dbmasteruser";
$password = "virtualcheckup";

$conn = new mysqli($servername, $username, $password, "virtual_checkup");
if ($conn->connect_error) {
	die ("connection fialed: " . $conn->connect_error);
}

/*$query = "SHOW TABLES FROM virtual_checkup;";
$result = $conn->query($query);

if (!$result) {
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
}
while ($row = mysqli_fetch_row($result)) {
  echo "Table: {$row[0]}" . PHP_EOL;
}
mysqli_free_result($result);
 */
?>
