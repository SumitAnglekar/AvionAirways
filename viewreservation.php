<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Avion Airways | Reservations</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src = "js/home.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background-image: url('images/airline2.jpg'); background-size: cover; background-repeat:no-repeat;">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.html"><img src="images/logo.png" alt="JustFly"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.html">HOME</a></li>
        <li><a href="viewFlights.php">FLIGHTS</a></li>
		<?php
		if(isset($_SESSION['username']))
		{
			echo("<li><a href='viewreservation.php'>RESERVATIONS</a></li>");
			echo("<li><a href='logout.php'>LOG OUT</a></li>");			
		}
		else
		{
			echo('<li><a href="loginPage.php">LOG IN</a></li>');
			echo('<li><a href="signUp.html">SIGN UP</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<!--Signup-->
<div class="jumbotron text-center" style="background-color:transparent">
<h1 style="color:#ffffff">Reservations</h1>
 </div>   
</div>
<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
  if(isset($_SESSION['username']))
  {
	echo ("<h3>Hi ". $_SESSION['username']. "!</h3>");
	$username = $_SESSION['username'];
	$link = mysqli_connect('localhost', 'root', '', 'avionairways');
	//check if user with same username exists in db
	$sql = "SELECT f.FlightNo, f.Source, f.Destination, f.DepartureDate, f.ArrivalDate, f.DepartureTime, f.ArrivalTime, b.Class  FROM flight f, books b WHERE b.AadharNo='". $_SESSION['aadharno']. "' AND f.FlightNo = b.FlightNo ;";
	$result = mysqli_query($link,$sql);
	 if (mysqli_num_rows($result)>0)
	 {
		echo("<table id='Reservations' class='table table-hover' name='Reservations' data-toggle='table' data-pagination='true' data-search='true'  data-fixed-columns='true'
       data-fixed-number='2'>");
		echo("<thead><th><FONT COLOR='FFFFFF'>Flight Number</th><th><FONT COLOR='FFFFFF'>Source</th><th><FONT COLOR='FFFFFF'>Destination</th><th data-sortable='true'><FONT COLOR='FFFFFF'>Departure Date</th><th data-sortable='true'><FONT COLOR='FFFFFF'>Arrival Date</th><th data-sortable='true'><FONT COLOR='FFFFFF'>Departure Time</th><th data-sortable='true'><FONT COLOR='FFFFFF'>Arrival Time</th><th><FONT COLOR='FFFFFF'>Class</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{		 	
		  	echo("<tr><td id='Reservations'>".$row[0]."</td><td>". $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td></tr>");
	}
		echo("</tbody></table>");
	}
	 else
	 {
	 	echo("Currently you have no reservations.");
	 }
  }
  else{
	  header("Location: home.html");
  }
  ?>
</div>
</body>
</html>

