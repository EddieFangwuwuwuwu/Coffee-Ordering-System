<?php
session_start();
include('database.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Email and password are required";
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE user_email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) === 1) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['user_password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user-id'] = $user['user_id'];
                    $_SESSION['email'] = $user['user_email'];
                    $_SESSION['username'] = $user['user_name'];
                    $_SESSION['user_profile'] = $user['user_profile'];
                    $_SESSION['user-role'] = $user['role'];
                    // set condition for user and admin login
                    // user redirected to homepage while admin redirected to dashboard
                    if($_SESSION['user-role'] === "user"){
                        header('Location: index.php');
                    } else if ($_SESSION['user-role'] === "admin"){
                        header("Location: admin/admin_dashboard.php");
                    }
                    exit;
                } else {
                    $error = "Incorrect password";
                }
            } else {
                $error = "User not found";
            }
        } else {
            $error = "Database error";
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
    <title>Eddie Coffee</title>
</head>

<body>
    <div id="loginContainer">

        <div id="loginBox">
            <div id="loginCover">
                <img src="./Images/loginCover.png" alt="loginCover">
            </div>
            <form method="post" id="inputField" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <h1>Login</h1>
                <div class="input-field">
                    <label id="emailLabel" for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-field">
                    <label for="password" id="passwordLabel">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <input id="loginButton" type="submit" value="Login">
                <span id="sign-up-link">Don't have an account? <a href="signUp.php">signUp</a></span>
                <?php if (!empty($error)) : ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </div>

    </div>
</body>

</html>