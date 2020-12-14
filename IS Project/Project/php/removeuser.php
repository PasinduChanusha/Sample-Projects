<?php
session_start();
require_once('db.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$id = $_GET["id"];



$sql = "DELETE FROM users WHERE id = '$id' ";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("deleted");';
    echo 'window.location.href="../manageusers.php";';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
