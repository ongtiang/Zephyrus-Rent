<?php
    /* DATABASE CONNECTION*/
    $con = mysqli_connect("localhost","root","","zephyrus_rent");

    if(!$con){
        die('Connection Failed'. mysqli_connect_error());
    }
?>
