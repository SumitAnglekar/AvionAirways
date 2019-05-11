<?php
session_start();
unset($_SESSION['aadharno']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['dob']);
unset($_SESSION['age']);
unset($_SESSION['contactno']);
unset($_SESSION['ffm']);
echo "<script>alert('You Have Logged Out Successfully');document.location='login.html'</script>";
?>