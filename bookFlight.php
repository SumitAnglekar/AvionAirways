<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Avion Airways | Book Flight</title>
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
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" class="shortPage" style="background-image: url('images/airline2.jpg'); background-size: cover; background-repeat:no-repeat;">

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
        <li><a href="viewflights.php">FLIGHTS</a></li>
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
<div class="jumbotron text-center" style="background-color: transparent;">
<h1><FONT COLOR='FFFFFF'>Booking Successful</h1>
  <?php
	if(!isset($_SESSION['username']))
	{
		header("Location: login.html");
	}	
	$onInstance = $_POST['OnwardInstanceID'];
	$classtype = $_SESSION['classtype'];
	$aadhar = $_SESSION['aadharno'];

	$link = mysqli_connect('localhost', 'root', '', 'avionairways');
	$sql = "INSERT INTO books (AadharNo,FlightNo,Class) values ('$aadhar', '$onInstance', $classtype');";
	$result = mysqli_query($link,$sql);
 

?>
<div class="row">
			<h3>Flight Information:</h3><br />
			<div class = "col-sm-2">
			</div>
			<div class = "col-sm-8">
			<?php
			if(!isset($_SESSION['username']))
			{
				header("Location: login.html");
			}	
			$onInstance = $_POST['OnwardInstanceID'];
			$classtype = $_SESSION['classtype'];
			$aadhar = $_SESSION['aadharno'];

			$link = mysqli_connect('localhost', 'root', '', 'avionairways');
			$sql = "INSERT INTO books (AadharNo,FlightNo,Class) VALUES ('$aadhar','$onInstance','$classtype');";
			$result = mysqli_query($link,$sql);
			$sql = "UPDATE airplane ap, flight f, flies fl SET capacity = capacity - 1 WHERE f.FlightNo = '".$onInstance."' AND f.FlightNo = fl.FlightNo AND ap.PCode = fl.PCode;";
			
			$result = mysqli_query($link,$sql);
				echo ("<h3>Onward Flight</h3>");
			 $sql = "SELECT * FROM flight f WHERE f.FlightNo = '".$onInstance."';";
			 $result = mysqli_query($link,$sql);

			 if (mysqli_num_rows($result)>0)
			 {

			 echo("<table class='table'>");
			 echo("<thead><th><FONT COLOR='FFFFFF'>Flight Number</th><th><FONT COLOR='FFFFFF'>Departure</th><th><FONT COLOR='FFFFFF'>Arrival</th><th><FONT COLOR='FFFFFF'> Departure Date</th><th><FONT COLOR='FFFFFF'>Arrival Date</th><th><FONT COLOR='FFFFFF'>Departure Time</th><th><FONT COLOR='FFFFFF'>Arrival Time</th></thead><tbody>");
			 while(($row = mysqli_fetch_row($result))!=null)
			 {
			 	echo("<tr><td><FONT COLOR='FFFFFF'>".$onInstance."</td><td> <FONT COLOR='FFFFFF'>" . $row[1]. "</td><td><FONT COLOR='FFFFFF'> ". $row[2]. "</td><td> <FONT COLOR='FFFFFF'>". $row[3]."</td><td><FONT COLOR='FFFFFF'>". $row[4]. "</td><td><FONT COLOR='FFFFFF'>". $row[5]. "</td><td><FONT COLOR='FFFFFF'>". $row[6]. "</td></tr>");
			 }
			 echo("</tbody></table>");
			}?>
		</div>	
 </div>   
</div>
</body>
</html>