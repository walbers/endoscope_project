<?php
?>

<html lang="en">
<head>
  <title>Virtual Checkup</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="index.css">

</head>

<body>
  <script src="index.js"></script>
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

  
  <header class="page-header header container-fluid">
    <div class="overlay">
      <div class="description">
        <h1>Welcome to your Vitrual Checkup!</h1>
	<p>This site lets you setup appointments with doctors/patients and video chat with them! It is a senior design project done by Will, Dishen, Richard, & Raj out of UIUC</p>
	
	<h2> Are you a patient? </h2>
	<div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3"></div>
          <div class="col-lg-3 col-md-3 col-sm-3">
	    <button class="btn btn-outline-secondary btn-lg" onclick="location.href='https://virtualcheckup.walbers.com/login.php'">Login</button>
	  </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
	    <button class="btn btn-outline-secondary btn-lg" onclick="location.href='https://virtualcheckup.walbers.com/register.php'">Register</button>
	  </div>
          <div class="col-lg-3 col-md-3 col-sm-3"></div>
        </div>
	
      <h2 id="doctor-message"> Are you a doctor? </h2> 
	<div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3"></div>
          <div class="col-lg-3 col-md-3 col-sm-3">
	    <button class="btn btn-outline-secondary btn-lg" onclick="location.href='https://virtualcheckup.walbers.com/login-doctor.php'">Login</button>
	  </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
	    <button class="btn btn-outline-secondary btn-lg" onclick="location.href='https://virtualcheckup.walbers.com/register-doctor.php'">Register</button>
	  </div>
          <div class="col-lg-3 col-md-3 col-sm-3"></div>
        </div>
      </div>
    </div>
  </header>

  


</body>

</html>
