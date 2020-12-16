<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['type'] != "driver") {
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
        <a href="index.php"><img src="images/logo.png" width=width="270" height="108" alt=""></a>
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
            $sql = "SELECT * FROM vehicles where vuser='" . $_SESSION['userid'] . "'";
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
        <button class="float" onclick="showadditem()">
            +
        </button>
    </div>


    <!-- add item modal  -->
    <div id="id01" class="modal">

        <form class="modal-content animate" action="php/addvehicle.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <label><b>Vehicle Image</b></label>
                Select a file: <input type="file" id="image" name="image" required>
                <br>
                <label><b>Vehicle No</b></label>
                <input type="text" placeholder="Enter Vehicle No" name="vno" required>
                <label><b>Vehicle Type</b></label>
                <input type="text" placeholder="Enter Vehicle Type" name="vtype" required>
                <label><b>Location</b></label>
                <input type="text" placeholder="Enter Vehicle Location" name="vloc" required>
                <label><b>Rate per 1km</b></label>
                <input type="text" placeholder="Enter Vehicle Rate" name="vrate" required>
                <label><b>Contact</b></label>
                <input type="text" placeholder="Enter Vehicle Contact" name="vcontact" required>

                <input type="hidden" name="vuser" value="<?php echo $_SESSION['userid'] ?>">

                <button type="submit">Add Vehicle</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="hideaddItem()" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        var updatemodal = document.getElementById('id01');

        function showadditem() {
            updatemodal.style.display = 'block'
        }

        function hideaddItem() {
            updatemodal.style.display = 'none'
        }
    </script>
</body>

</html>