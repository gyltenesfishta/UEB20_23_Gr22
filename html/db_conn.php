<?php

$sname = "localhost:3307";
$uname = "root";
$password = "";

$db_name = "my_db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if(!$conn) {
    echo "Connection Failed!";
    exit();
}
return $conn;
?>