<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['type'] != "admin") {
    //if not logged in redirect to home page
    //cant access this page by changing the address
    require('php/loginredirect.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link href="css/user.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="sidenav">
        <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
        <?php
            echo "<a style='pointer-events:none;'>User: <b>" . $_SESSION['fname'] . "</b></a>";
        ?>
        <a href="admin.php">All Vehicles</a>
        <a href="manageusers.php">Manage Users</a>
        <a href="allbookings.php">View Bookings</a>

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
                <th>Image</th>
                <th>Vehicle No</th>
                <th>Type</th>
                <th>Location</th>
                <th>Rate per 1km</th>
                <th>Contact</th>
                <th></th>
            </tr>
            <?php
            require_once('php/db.php');


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "";
            $sql = "SELECT * FROM vehicles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>" . $row['id'] . "</td>
                        <td><img alt='No Image Found' height='100px' width='100px' src='data:image/jpeg;base64," . base64_encode($row["image"]) . "'/></td>
                        <td>" . $row['vno'] . "</td>
                        <td>" . $row['vtype'] . "</td>
                        <td>" . $row['vloc'] . "</td>
                        <td>" . $row['vrate'] . "</td>
                        <td>" . $row['vcontact'] . "</td>
                        <td><a href='php/removevehicle.php?id=" . $row['id'] . "'>Remove Vehicle</a></td>

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