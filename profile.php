<?php
session_start();
include('database.php');

if (!isset($_SESSION['user-id'])) {
    header("Location: login.php");
    exit;
}

$query = 'SELECT user_name, user_email, user_profile FROM users WHERE user_id = ?';
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user-id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $userProfile = $row['user_profile'] ?: 'Images/default.jpg';
    $username = $row['user_name'];
    $email = $row['user_email'];
    $_SESSION['username'] = $username;
    $_SESSION['user_profile'] = $userProfile;
} else {
    $userProfile = 'Images/default.jpg';
    $username = '';
    $email = '';
    $_SESSION['user_profile'] = $userProfile;
}

if (isset($_POST['saveChange'])) {
    $name  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Only handle upload if user actually selected a file
    if (!empty($_FILES['profile-picture']['name'])) {

        // If upload has error (including too big etc.)
        if ($_FILES['profile-picture']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash_error'] = "Upload failed (error code: " . $_FILES['profile-picture']['error'] . ")";
            header("Location: profile.php");
            exit;
        }

        $tmpName       = $_FILES['profile-picture']['tmp_name'];
        $originalName  = $_FILES['profile-picture']['name'];
        $ext           = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowed       = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed, true)) {
            $_SESSION['flash_error'] = "File extension not allowed!";
            header("Location: profile.php");
            exit;
        }

        $newName     = bin2hex(random_bytes(8)) . '.' . $ext;
        $destination = 'Images/' . $newName;

        if (!move_uploaded_file($tmpName, $destination)) {
            $_SESSION['flash_error'] = "File failed to upload (cannot move file).";
            header("Location: profile.php");
            exit;
        }

        // Only update profile path if upload succeeded
        $userProfile = $destination;
    }

    $query = 'UPDATE users SET user_name = ?, user_email = ?, user_profile = ? WHERE user_id = ?';
    $stmt  = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $userProfile, $_SESSION['user-id']);

    if (!mysqli_stmt_execute($stmt)) {
        $_SESSION['flash_error'] = "Database update failed.";
        header("Location: profile.php");
        exit;
    }

    $_SESSION['username']      = $name;
    $_SESSION['user_profile']  = $userProfile;
    $_SESSION['flash_success'] = "Profile updated successfully!";
    header("Location: profile.php");
    exit;
}

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
    <?php if($_SESSION['user-role'] === 'admin'):?>
        <?php require('admin/include/admin_header.php') ?>
    <?php else: ?>
        <?php require('includes/header.php') ?>
    <?php endif ?>
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="flash flash-success">
            <p><?= htmlspecialchars($_SESSION['flash_success']) ?></p>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php elseif (isset($_SESSION['flash_error'])): ?>
        <div class="flash flash-error">
            <p><?= htmlspecialchars($_SESSION['flash_error']) ?></p>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php
    endif;
    ?>
    <div id="user-profile-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" id="user-profile-form">
            <div id="profile-pic-container">
                <label for="profile-pic">Profile picture</label>
                <img src="<?= htmlspecialchars($userProfile) ?>" alt="" id="profile-picture">
                <input type="file" id="profile-pic" name="profile-picture" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <div id="username-container">
                <label for="username">Name</label>
                <input type="text" name="username" id="username" placeholder="<?= $username ?>" value="<?= htmlspecialchars($username) ?>">
            </div>
            <div id="email-container">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="<?= $email ?>" value="<?= htmlspecialchars($email) ?>">
            </div>
            <input type="submit" value="Save Change" name="saveChange" id="save-change-btn">
        </form>
        <form action="./admin/admin_dashboard.php" method="post">
            <input type="submit" value="Back to Dashboard" id="back-dashboard-btn">
        </form>
    </div>
    <?php if($_SESSION['user-role'] === 'user'): ?>
        <?php require('includes/footer.php') ?>
    <?php endif; ?>
</body>

</html>