<?php
session_start();
include('../database.php');
include('admin_guard.php'); // blocks non-admins
$selectedSide = "feedbacks";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="admin-page">
        <?php include('include/admin_sidebar.php'); ?>
        <main class="admin-page-content">
            <?php include('include/admin_header.php')?>
            
        </main>

</body>

</html>