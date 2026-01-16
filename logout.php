<?php 
session_start();

$_SESSION = [];

session_destroy();

//redirect to php
header("Location: index.php");
exit;

?>