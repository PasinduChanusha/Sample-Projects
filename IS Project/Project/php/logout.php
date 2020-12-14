<?php session_start(); session_unset(); ?> 
    <script>
        window.onload = function(){
            let url = window.location.href;
            if(url.includes("?signout")) {
                window.location.href = '../index.php?login';
            }
            else {
                window.location.href = '../index.php';
            }
        }
    </script>

