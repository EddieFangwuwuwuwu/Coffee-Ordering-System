<?php
session_start();
include('database.php');
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!$username || !$email || !$password) {
        $error = "All fields are required";
    } else {
        // check if email and username existed
        $query = 'SELECT user_id FROM users WHERE user_name = ? OR user_email = ?';
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $exisitingUser = mysqli_fetch_assoc($result);

            if ($existingUser['user_name'] === $username) {
                $error = "Username already existed";
            } elseif ($exisiting['user_email'] === $email) {
                $error = "Email already existed";
            }
        } else {
            $insertQuery = "INSERT INTO users (user_name, user_email, user_password, role) VALUES(?,?,?,'user')";
            $stmt2 = mysqli_prepare($conn, $insertQuery);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt2, 'sss', $username, $email, $hashedPassword);
            mysqli_stmt_execute($stmt2);

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Sign Up</title>
</head>

<body>
    <div id="signUpContainer">
        <div id="signUpBox">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="signUpForm">
                <h1>Sign Up</h1>
                <div class="sign-up-input">
                    <label for="email" id="email-label">Email</label>
                    <input type="email" id="email" name="email">
                    <!-- for email existed error-->
                </div>
                <div class="sign-up-input">
                    <label for="username" id="username-label">Username</label>
                    <input type="text" id="username" name="username" minlength="6" maxlength="15">
                </div>
                <!-- for username existed error-->
                <div class="sign-up-input">
                    <label for="password" id="password-label">Password</label>
                    <input type="password" id="password" name="password" minlength="6" maxlength="12">
                </div>
                <input type="submit" name="signUp" id="sign-up-btn" value="Sign Up">
                <span>Already have an account? <a href="login.php">Login</a></span>
                <?php if (!empty($error)): ?>
                    <p style="color:red; text-align:center;">
                        <?= htmlspecialchars($error) ?>
                    </p>
                <?php endif; ?>
            </form>

            <div id="sign-up-cover">
                <img src="./Images/signUpCover.png" alt="sign up cover">
            </div>
        </div>
    </div>
</body>

</html>