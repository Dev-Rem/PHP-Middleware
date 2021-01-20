<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $db = "users";
    $dbpass = "dbpass";

    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
?>
