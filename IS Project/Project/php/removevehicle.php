<?php
session_start();
require_once('db.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$id = $_GET["id"];



$sql = "DELETE FROM vehicles WHERE id = '$id' ";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("deleted");';
    if ($_SESSION['type'] == 'admin') {
        echo 'window.location.href="../admin.php";';
    } else {
        echo 'window.location.href="../driver.php";';
    }
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
