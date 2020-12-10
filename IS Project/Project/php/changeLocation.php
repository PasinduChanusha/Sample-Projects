<?php
session_start();
$_SESSION["location"] = $_POST["location"];
echo '<script language="javascript">';
echo 'window.location.href="../customer.php";';
echo '</script>';
?>
