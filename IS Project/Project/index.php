<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>HireMyCab</title>
    <script>
        window.onload = function(){
            let url = window.location.href;
            if(url.includes("?login")) {
                <?php 
                    if(isset($_SESSION['userid'])){
                        echo "
                        var signOut = confirm('You are already logged in as " . $_SESSION['fname'] . ". Do you want to sign out?');
                        if (signOut == true) {
                            window.location.href = 'php/logout.php?signout';
                        }
                        else {
                            window.location.href = 'index.php';
                        }
                        ";
                    }
                    else {
                        echo "
                        showLogin();
                        ";
                    }
                ?>
            }
        }
    </script>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="ticker">
        <marquee>
            <img src="images/taxi.png" alt="" width="95" height="50">
            <a style="font-size: 60px; padding: 0pt 50pt;"> <b>Welcome to <i>HireMyCab!</i></b> </a>
        </marquee>
    </div>
    <div class="topnav">
        <a style="float: left; padding: 1px 0px;"><img src="images/logo.png" width="180" height="72" alt=""></a>
        <a href="#about">About Us</a>
        
        <?php
        if (isset($_SESSION['userid'])) {
            echo '<a href="php/logout.php">Sign Out</a>';
            if ($_SESSION["type"] == 'driver') {
                echo '<a href="driver.php">Driver Dashboard</a>';
            } else if ($_SESSION["type"] == 'customer') {
                echo '<a href="customer.php">Customer Dashboard</a>';
            }else if ($_SESSION["type"] == 'admin') {
                echo '<a href="admin.php">Admin Panel</a>';
            }
            echo "<a style='pointer-events:none;'><b>Welcome " . $_SESSION['fname'] . "!</b></a>";
        }
        else {
            echo '<a href="#" onclick="showsignup()">Sign Up</a>';
            echo '<a href="#" onclick="showLogin()">Login</a>';
        }
        ?>
    </div>
    <hr>
    <div class="Description">
        <div class="descriptionChild">
            <img src="images/driver.png" alt="driver image">
        </div>
        <div class="descriptionChild">
            
                <div style="width: 100%;    ">
                    <h1>Rent Your Cab With Us</h1>
                </div>
                <div style="width: 70%; font-size: 20px" >
                    <p>Looking for a best place to rent your cab? You’ve come to the right place. 
                    Sri Lanka is a country that is promoting new opportunities to all people to 
                    explore various job sectors. Accordingly, transport has been a field that needed 
                    regular change. The demand for drivers and cabs is rising day by day. Renting your 
                    cab with <b>HireMyCab</b> would not only be an investment but you can enjoy a lot of rewards by driving trips. 
                    The required training and technical knowledge would be provided our support team itself.
                    </p>
                </div>
            
        </div>
    </div>
    <hr>

    <div class="Description">
        <div class="descriptionChild" style="text-align: right;">
            
                <div style="width: 100%">
                    <h1>Hire A Cab Via Us</h1>
                </div>
                <div style="margin-left: 30%; font-size: 20px">
                    <p>
                    Transportation is a hectic need in the present days. People’s 
                    lives have become very rapid and keeps on changing from time to time. 
                    We provide the required help to make your lives much simpler and to 
                    help you get through the day easily. All you have to do is visit 
                    HireMyCab and login as one of our users. Then in a click of a button you 
                    can travel anywhere you want in the easiest and the fastest possible route. 
                    This is very user friendly and easily accessible.
                    </p>
                </div>
            
        </div>
        <div class="descriptionChild">
        <center>
            <img src="images/customer.png" alt="">
        </center>
        </div>
    </div>
    <hr>
    <div class="Description">
        <center>
            <h1 id=about>About Us</h1>
            <br>
            <div style="font-size: 20px; width:70%">
            <p>
            The primary motive of Hire My Cab is problem-solving the Sri Lankan transport 
            sector through technology. We provide all services demanded by the customers 
            in the best most quality. You can access us from any place within a couple of 
            seconds. Our service has been recognized as of best quality. Please do not 
            hesitate us for further information and queries.
            </p>
            </div>
        </center>
    </div>
    <hr>



    <!-- login modal  -->
    <div id="id01" class="modal">

        <form class="modal-content" action="php/login.php" method="post">
            <div class="container">
                <label ><b>Email</b></label>
                <input type="email" placeholder="Enter Username" name="email" required>

                <label ><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="hideLogin()" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>


    <!-- Sign Up modal  -->
    <div id="id02" class="modal">

        <form class="modal-content" action="php/signup.php" method="post">
            <div class="container">
                <label><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                <label><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>
                <label><b>Email</b></label>
                <input type="email" placeholder="Email" name="email" required>
                <label><b>Register as</b></label>
                <select name="type">
                    <option value="driver" selected>Driver</option>
                    <option value="customer" selected>Customer</option>
                </select>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="signuppassword" name="password" required>
                <label><b>Retype Password</b></label>
                <input type="password" placeholder="Retype Password" id="confirm_password" required>

                <button type="submit">Sign Up</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="hidesignup()" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>


    <script>
        // Get the login modal
        var Loginmodal = document.getElementById('id01');

        function showLogin() {
            Loginmodal.style.display = 'block'
        }

        function hideLogin() {
            Loginmodal.style.display = 'none'
        }

        // Get the signup modal
        var Signupmodal = document.getElementById('id02');

        function showsignup() {
            Signupmodal.style.display = 'block'
        }

        function hidesignup() {
            Signupmodal.style.display = 'none'
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == Signupmodal || event.target == Loginmodal) {
                hidesignup();
                hideLogin();
            }
        }


        //check password matching
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