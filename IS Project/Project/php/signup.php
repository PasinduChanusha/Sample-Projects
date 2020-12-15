<?php
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$fname= $_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$type= $_POST["type"];
$pw=md5($_POST["password"]);



$sql = "INSERT INTO users(`fname`, `lname`, `email`, `type`, `password`) VALUES ('$fname','$lname','$email','$type','$pw');";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
	echo 'alert("Registration Successfull. Please Login");';
	echo 'window.location.href="../index.php";';
	echo '</script>';

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

