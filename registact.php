<?php
session_start();
error_reporting(0);
include('includes/config.php');
$fname = $_POST['fullname'];
$email = $_POST['emailid'];
$mobile = $_POST['mobileno'];
$alamat = $_POST['alamat'];
$pass = $_POST['pass'];
$conf = $_POST['conf'];
if ($conf != $pass) {
	echo "<script>alert('Password is not the same!');</script>";
	echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
} else {
	$sqlcek = "SELECT email FROM member WHERE email='$email'";
	$querycek = mysqli_query($koneksidb, $sqlcek);
	if (mysqli_num_rows($querycek) > 0) {
		echo "<script>alert('Email already registered, please use another email!');</script>";
		echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
	} else {
		$password = md5($_POST['pass']);
		$sql1 = "INSERT INTO member(nama_user,email,telp,password,alamat) VALUES('$fname','$email','$mobile','$password','$alamat')";
		$lastInsertId = mysqli_query($koneksidb, $sql1);
		if ($lastInsertId) {
			echo "<script>alert('Registration is successful. You can now login.');</script>";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		} else {
			echo "<script>alert('Ops, an error occurred. Please try again.');</script>";
			echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
		}
	}
}
