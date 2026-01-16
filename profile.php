<?php session_start();
include('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>User Profile</title>
</head>
<body>
    <?php require('includes/header.php')?>
    <div id="user-profile-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
            <label for="profile-pic">Profile picture</label>
            <input type="file" id="profile-pic" name="profile-picture" accept=".jpg, .jpeg, .png, .gif">
            <label for="username">Name</label>
            <input type="text" name="username" id="username">
        </form>
    </div>
    <?php require('includes/footer.php')?>
</body>
</html>