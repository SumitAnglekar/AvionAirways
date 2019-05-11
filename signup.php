<?php
session_start();
//Retrieve form parameters
$aadhar = $_POST['aadharno'];
$email = $_POST['email'];
$password = $_POST['password'];
$dob = $_POST['dob'];
$contactno = $_POST['contactno'];
$age=18;
$ffm=0;
echo $aadhar. " ". $email. " ". $password. " ". $bdate[2]. " ". $contactno;
// connect to the mysql database
$link = mysqli_connect('localhost', 'root', '', 'avionairways');
//check if user with same username exists in db
$sql = "SELECT * FROM user WHERE username = '".$email."';";
$result = mysqli_query($link,$sql);

if(mysqli_fetch_row($result)!=null)
{
	$_SESSION['error_msg'] =  "User with this username already exists. Please sign up with a different username";
	header("Location: errorpage.php");
	session_write_close();
}
else
{
$sql = "INSERT INTO passenger (UserName,Password,AadharNo,FFM,Age,DOB,ContactNo) VALUES ('$email','$password','$aadhar','$ffm','$age','$dob','$contactno');";
echo $sql;

// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result){ 
	//echo("SQL Error");
	$_SESSION['error_msg'] = "There was a problem while signing up. Please try again.";
	header("Location: errorpage.php");
  die(mysqli_error());
}
else
{
	$_SESSION['aadharno'] = $aadhar;
 	$_SESSION['username'] = $email;
	$_SESSION['password'] = $password;
	$_SESSION['dob'] = $bdate;
	$_SESSION['age'] = $age;
	$_SESSION['contactno'] = $contactno;
	$_SESSION['ffm'] = $ffm;
header("Location: home.html");
}
}

?>