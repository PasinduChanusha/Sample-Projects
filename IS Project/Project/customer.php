<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['type'] != "customer") {
    //if not logged in redirect to home page
    //cant access this page by changing the address

    require('php/loginredirect.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Customer</title>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link href="css/user.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="sidenav">
        <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
        <?php
            echo "<a style='pointer-events:none;'>User: <b>" . $_SESSION['fname'] . "</b></a>";
        ?>
        <a href="customer.php">Find a Cab</a>
        <a href="mybookings.php">My Bookings</a>

        <a href="profile.php">My Profile</a>
        <a href="php/logout.php">Sign Out</a>
    </div>

    <div class="main">
        <marquee>
            <img class="" src="images/taxi.png" alt="" width="190" height="100">
        </marquee>
        <hr>
        <form method="POST" action="php/changeLocation.php">
            <input type="text" placeholder="Enter pickup location" name="location" id="location">
            <button type="submit">Search</button>
        </form>
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
                <th>Booking Date</th>
                <th>My Detail</th>
                <th>Book</th>
            </tr>

            <?php
            if (isset($_SESSION["location"])) {
                require_once('php/db.php');


                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                echo "";
                $sql = "SELECT * FROM vehicles where vloc='" . $_SESSION["location"] . "'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "
                    <tr>
                        <td>" . $row['id'] . "</td>
                        <td><img alt='No Image Found' src='data:image/jpeg;base64," . base64_encode($row["image"]) . "'/></td>
                        <td>" . $row['vno'] . "</td>
                        <td>" . $row['vtype'] . "</td>
                        <td>" . $row['vloc'] . "</td>
                        <td>" . $row['vrate'] . "</td>
                        <td>" . $row['vcontact'] . "</td>
                        <form method='post' action='php/addboking.php'>
                            <td><input type='date' name='date' required></td>
                            <td><input type='text' name='detail' required></td>
                            <td><input type='hidden' name='vno' value='" . $row['vno'] . "'></td>
                            <td><input type='hidden' name='driverid' value='" . $row['vuser'] . "'></td>
                            <td><input type='submit'></td>
                        </form>
                    </tr>
                    ";
                    }
                } else {
                    echo "<script>alert('Type a city to begin.');</script>";
                }
                $conn->close();
            } else {
                echo "<script>alert('Type a city to begin.');</script>";
            }
            ?>
        </table>
    </div>
</body>

</html>