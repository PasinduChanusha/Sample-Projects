<?php
    if(!isset($_SESSION['userid'])) {
        echo "
        <script type='text/javascript'>
            alert('Please login or signup to continue.');
            window.location.href = './index.php?login';
        </script>
        ";
    }
    else {
        echo "
        <script type='text/javascript'>
            var signOut = confirm('You are logged in as " . $_SESSION['type'] . ". Do you want to sign out?');
            if (signOut == true) {
                window.location.href = 'php/logout.php?signout';
            }
            else {
                window.location.href = './index.php';
            }
        </script>
        ";
    }

?>

