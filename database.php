<?php

$dbhost = 'localhost';
$username = 'root';
$password = '1234';
$db = "coffeeShop";
$conn = "";

try{
    $conn = mysqli_connect($dbhost,$username,$password,$db);
} catch(mysqli_sql_exception){
    echo "Could not connect";
}

?>