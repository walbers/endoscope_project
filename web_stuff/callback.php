<?php
?>

<html>

<head>
    <title>Fitbit API JavaScript</title>
    <style> rect {fill: lightblue; stroke: black; }</style>
</head>

<body>

    <title>Fitbit Dashboard</title>
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



    <svg width=300 height=300></svg>
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="app.js"></script>
    <button onclick="revokeAccess()">revokeAccess</button>

</body>

</html>


