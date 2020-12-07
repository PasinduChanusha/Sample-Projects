<?php
session_start();
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$vno= $_POST["vno"];
$date=$_POST["date"];
$details=$_POST["detail"];
$vowner=$_POST["driverid"];
$orderedby=$_SESSION["email"];


$sql = "INSERT INTO bookings(`vno`, `date`, `details`, `vowner`, `orderedby`) VALUES ('$vno','$date','$details','$vowner','$orderedby');";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
	echo 'alert("Booking Placed");';
	echo 'window.location.href="../customer.php";';
	echo '</script>';

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

