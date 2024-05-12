<?php
    $host="localhost";
    $dbuname="hitham";
    $dbpass="1234";
    $dbname="3arka";

    $mysqli = new mysqli($host,$dbuname,$dbpass,$dbname);
    mysqli_set_charset($mysqli, "utf8mb4");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
 ?>
