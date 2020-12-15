<?php
session_start();
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$fname= $_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$pw=md5($_POST["password"]);



$sql = "UPDATE users SET `fname`='$fname',`lname`='$lname',`email`='$email',`password`='$pw' where id=".$_SESSION['userid'].";";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
	echo 'alert("Update Successfull");';
	echo 'window.location.href="../profile.php";';
	echo '</script>';

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

