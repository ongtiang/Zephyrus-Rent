<?php
    //This file will connect to the database and this file will be used whenever there is a need to connect the database 
    $username = 'root' ; 
    $password = '' ;  
    $database = 'zephyrus_rent' ; 
    $con = mysqli_connect('localhost',$username , $password, $database) ; 
    if($con->connect_errno){
        die('Connection Failed:'.$con->connect_error) ; 
    }
?>