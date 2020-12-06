<?php
header('Access-Control-Allow-Origin: *');
?>

<html>

<head>
    <title>Sending request to local</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <p>Light brightness</p>
    <div class="slidecontainer">
      <input type="range" min="0" max="9" value="0" class="slider" id="myRange">
    </div>
    <script src="arduino.js"></script>
</body>

</html>


