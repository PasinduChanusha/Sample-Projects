<?php
session_start();
if(!isset($_SESSION['userid'])){
    //if not logged in redirect to home page
    //cant access this page by changing the address
    require('php/loginredirect.php');
} 
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?php
        if($_SESSION['type']=='driver'){
            echo 'Driver';
        }
        else if($_SESSION['type']=='customer'){
            echo 'Customer';
        }
        else if($_SESSION['type']=='admin'){
            echo 'Admin';
        }
        ?>

    </title>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link href="css/user.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        if($_SESSION['type']=='driver'){
            echo 
            '
            <div class="sidenav">
                <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
                <a style="pointer-events:none;">User: <b>' . $_SESSION["fname"] . '</b></a>
                <a href="driver.php">My Vehicles</a>
                <a href="hirerequests.php">Hire Requests</a>
        
                <a href="profile.php">My Profile</a>
                <a href="php/logout.php">Sign Out</a>
            </div>
            ';
        }
        else if($_SESSION['type']=='customer'){
            echo
            '
            <div class="sidenav">
                <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
                <a style="pointer-events:none;">User: <b>' . $_SESSION["fname"] . '</b></a>
                <a href="customer.php">Find a Cab</a>
                <a href="mybookings.php">My Bookings</a>
        
                <a href="profile.php">My Profile</a>
                <a href="php/logout.php">Sign Out</a>
            </div>
            ';
        }
        else if($_SESSION['type']=='admin'){
            echo
            '
            <div class="sidenav">
                <a href="index.php"><img src="images/logo.png" width="270" height="108" alt=""></a>
                <a style="pointer-events:none;">User: <b>' . $_SESSION["fname"] . '</b></a>
                <a href="admin.php">All Vehicles</a>
                <a href="manageusers.php">Manage Users</a>
                <a href="allbookings.php">View Bookings</a>

                <a href="profile.php">My Profile</a>
                <a href="php/logout.php">Sign Out</a>
            </div>
            ';
        }
    ?>
    

    <div class="main">
        <marquee>
            <img class="" src="images/taxi.png" alt="" width="190" height="100">
        </marquee>
        <hr>
        <?php
        require_once('php/db.php');


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "";
        $sql = "SELECT * FROM users where id='" . $_SESSION['userid'] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        ?>
                <form class="modal-content animate" action="php/updateprofile.php" method="post">
                    <div class="container">
                        <label><b>First Name</b></label>
                        <input type="text" value="<?php echo $row['fname'] ?>" name="fname" required>
                        <label><b>Last Name</b></label>
                        <input type="text" value="<?php echo $row['lname'] ?>" name="lname" required>
                        <label><b>Email</b></label>
                        <input type="email" value="<?php echo $row['email'] ?>" name="email" required>

                        <label><b>Enter Password</b></label>
                        <input type="password" placeholder="Enter Password" id="signuppassword" name="password" required>
                        <label><b>Retype Password</b></label>
                        <input type="password" placeholder="Retype Password" id="confirm_password" required>

                        <button type="submit">Update Profile</button>
                    </div>
                </form>
        <?php
            }
        } else {
        }
        $conn->close();
        ?>
    </div>
    
    <script>
        var password = document.getElementById("signuppassword"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</body>

</html>