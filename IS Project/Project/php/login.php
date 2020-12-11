<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["email"]);
unset($_SESSION["type"]);
unset($_SESSION["location"]);

require_once('db.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

$email = $_POST["email"];
$logpass = md5($_POST["password"]);



$sql = "SELECT * FROM users where email='" . $email . "' && password='" . $logpass . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $id = $row['type'];
        $_SESSION['userid'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['type'] = $row['type'];
        if ($id == 'driver') {
            header("Location: ../driver.php", true, 301);
        } else if ($id == 'customer') {
            header("Location: ../customer.php", true, 301);
        }else if ($id == 'admin') {
            header("Location: ../admin.php", true, 301);
        }
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("Username Or Password not valid");';
    echo 'window.location.href="../index.php";';
    echo '</script>';
}
$conn->close();
