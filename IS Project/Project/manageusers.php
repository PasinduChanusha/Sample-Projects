<?php
session_start();
if (!isset($_SESSION['userid'])  || $_SESSION['type'] != "admin") {
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Type</th>
                <th></th>
            </tr>
            <?php
            require_once('php/db.php');


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "";
            $sql = "SELECT * FROM users where email!='" . $_SESSION['email'] . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['fname'] . "</td>
                        <td>" . $row['lname'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['type'] . "</td>
                        <td><a href='php/removeuser.php?id=" . $row['id'] . "'>Remove User</td>
                    </tr>
                    ";
                }
            } else {
            }
            $conn->close();

            ?>


        </table>
        <button class="float" onclick="showaddUser()">
            +
        </button>
    </div>


    <!-- add User modal  -->
    <div id="id01" class="modal">
        <form class="modal-content animate" action="php/adduser.php" method="post">
            <div class="container">
                <label><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                <label><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>
                <label><b>Email</b></label>
                <input type="email" placeholder="Email" name="email" required>
                <label><b>Register as</b></label>
                <select name="type">
                    <option value="admin" selected>Admin</option>
                    <option value="driver" selected>Driver</option>
                    <option value="customer" selected>Customer</option>
                </select>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="signuppassword" name="password" required>

                <button type="submit">Add User</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="hideaddUser()" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        var Usermodal = document.getElementById('id01');

        function showaddUser() {
            Usermodal.style.display = 'block'
        }

        function hideaddUser() {
            Usermodal.style.display = 'none'
        }
    </script>
</body>

</html>