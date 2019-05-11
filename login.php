<?php
session_start();
$email = $_POST['username'];
$password = $_POST['password'];
$link = mysqli_connect('localhost', 'root', '','avionairways');
$sql = "SELECT password, aadharno,dob,age,contactno,ffm FROM passenger WHERE username = '".$email."';";
echo $sql;
$result = mysqli_query($link,$sql);
if($result)
{
	$row = mysqli_fetch_row($result);
	if($row!=null && strcasecmp($row, $password) == 0)
	{
		$_SESSION['aadharno'] = $aadhar;
 		$_SESSION['username'] = $email;
		$_SESSION['password'] = $password;
		$_SESSION['dob'] = $bdate;
		$_SESSION['age'] = $age;
		$_SESSION['contactno'] = $contactno;
		$_SESSION['ffm'] = $ffm;
		session_write_close();
		echo "Authenticated";
				if(isset($_POST['redirurl'])) 
				{
					$url = $_POST['redirurl'];
					header("Location:$url");
				}
				else
				{
					header("Location: home.html");
				}
	}
	else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorpage.php");
	}
}
else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorPage.php");
	}
?>