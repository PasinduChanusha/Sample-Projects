<?php
require_once('db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$vno= $_POST["vno"];
$vtype=$_POST["vtype"];
$vrate=$_POST["vrate"];
$vcontact= $_POST["vcontact"];
$vuser=$_POST["vuser"];
$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
$vloc =$_POST["vloc"];


$sql = "INSERT INTO vehicles(`vno`, `vtype`, `vrate`, `vcontact`, `vuser`, `image`,`vloc`) VALUES ('$vno','$vtype','$vrate','$vcontact','$vuser','$image','$vloc');";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
	echo 'alert("Vehicle Added Successfully");';
	echo 'window.location.href="../driver.php";';
	echo '</script>';

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
