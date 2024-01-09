<?php

    $serverName = "localhost";
    $dbUsername = "chanupa123";
    $dbPassword = "E!Wg0eX2xN!dzxM1";
    $dbName = "shop";

    $connection = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

    if(!$connection){
       die("Connection failed : " . mysqli_connect_error()); 
    }

?>