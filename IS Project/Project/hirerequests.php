<?php
session_start();
if (!isset($_SESSION['userid'])  || $_SESSION['type'] != "driver") {
    //if not logged in redirect to home page
    //cant access this page by changing the address
    require('php/loginredirect.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Driver</title>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link href="css/user.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="sidenav">
        <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
        <?php
            echo "<a style='pointer-events:none;'>User: <b>" . $_SESSION['fname'] . "</b></a>";
        ?>
        <a href="driver.php">My Vehicles</a>
        <a href="hirerequests.php">Hire Requests</a>

        <a href="profile.php">My Profile</a>
        <a href="php/logout.php">Sign Out</a>
    </div>

    <div class="main">
        <marquee>
            <img class="" src="images/taxi.png" alt="" width="190" height="100">
        </marquee>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Vehicle No</th>
                <th>Date</th>
                <th>Details</th>
                <th>Ordered By</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            require_once('php/db.php');


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "";
            $sql = "SELECT * FROM bookings where vowner='" . $_SESSION['userid'] . "' and status!='rejected'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['vno'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['details'] . "</td>
                        <td>" . $row['orderedby'] . "</td>
                        <td>" . $row['status'] . "</td>
                        <td><a href='php/approveride.php?id=" . $row['id'] . "'><button>Approve</button></a></td>
                        <td><a href='php/rejectride.php?id=" . $row['id'] . "'><button class='cancelbtn'>Reject</button></a></td>
                    </tr>
                    ";
                }
            } else {
            }
            $conn->close();

            ?>


        </table>
    </div>
</body>

</html>