<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Avion Airways - The easiest way to fly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src = "js/home.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" style="background-image: url('images/airline2.jpg'); background-size: cover; background-repeat:no-repeat;">
<style>
.card1 {
	background: none;
  max-width: fit-content;
  margin: auto;
  text-align: center;
  font-family: arial;
  margin-top: 150px;
}

button {
  border: none;
  outline: 0;
  /* display: inline-block; */
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 30%;
  font-size: 18px;
  /* margin-	: 400px; */
}

table{
    margin-left: 20px;
    text-align: left;
}
td {
  text-decoration: none;
  font-size: 22px;
  color: white;
  width:210px;
  padding-bottom: 10px;
  padding-left: 10px;
}
h2{
    text-align: center;
    margin-top: 100px;
}
button:hover, a:hover {
  opacity: 0.7;
}
</style>
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
        <li><a href="viewfligths.php">FLIGHTS</a></li>
		<?php
		if(isset($_SESSION['username']))
		{
			echo("<li><a href='viewreservation.php'>RESERVATIONS</a></li>");
			echo("<li><a href='logout.php'>LOG OUT</a></li>");			
		}
		else
		{
			echo('<li><a href="login.html">LOG IN</a></li>');
			echo('<li><a href="signup.html">SIGN UP</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>
<div class="card1">
	<h2>My Profile</h2>
<?php
if (isset($_SESSION['username'])) {
  } 
$uname = $_SESSION['username'];
$aadhar=$_SESSION['aadharno'];
$email=$_SESSION['username'];
$password=	$_SESSION['password'];
$dob=$_SESSION['dob'];
$age=$_SESSION['age'];
$contactno=$_SESSION['contactno'];
$ffm=	$_SESSION['ffm'];
$link = mysqli_connect('localhost', 'root', '' , 'avionairways');
//check if user with same username exists in db
//$sql = "SELECT * FROM user WHERE username = '".$uname."';";
$sql = "SELECT aadharno,username,contactno,ffm,dob,age FROM passenger WHERE username = '$uname';";
$result = mysqli_query($link,$sql);

// 
if(($row = mysqli_fetch_row($result))!=null)
{
	echo("<table><thead></thead><tbody>
	<tr>
		<td>Aadhar Number</td>
		<td>$row[0]</td>
	</tr>
	<tr>
		<td>Email ID</td>
		<td>$uname</td>
	</tr>
	<tr>
		<td>Contact No</td>
		<td>$row[2]</td>
	</tr>
	<tr>
		<td>Frequent Flier Miles</td>
		<td>$row[3]</td>
	</tr>
	<tr>
		<td>Date Of Birth</td>
		<td>$row[4]</td>
	</tr>
	<tr>
		<td>Age</td>
		<td>$row[5]</td>
	</tr>
	</thead><tbody>");
}
else
{
	$_SESSION['error_msg'] = "User does not exist.";
	header("Location: errorpage.php");
	session_write_close();
	
}

?>

</div>
<div>
</div>
</body>
</html>
