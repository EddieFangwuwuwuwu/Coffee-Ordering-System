<?php
if(!isset($_SESSION['user-role'])){
    header('Location: ../login.php');
    exit;
} else{
    if($_SESSION['user-role'] !== 'admin'){
        http_response_code(403);
        include('../includes/403.php');
        exit;
    }
}
?>