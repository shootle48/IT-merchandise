<?php
    $hostname = "localhost";
    $Username = "root";
    $password = "";
    $database = "it-merchandise";

    $connection = mysqli_connect($hostname,$Username,$password,$database);
    if(!$connection){
        die(mysqli_connect_error());
    }
?>