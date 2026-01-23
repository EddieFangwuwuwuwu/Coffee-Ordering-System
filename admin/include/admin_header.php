<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../admin_guard.php';// blocks non-admins
?>

<header id="admin-header">
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></p>
    <div id="admin-info">
        <div id="admin-setting">
            <button id="admin-trigger">
                <img src="<?= htmlspecialchars('../../' . ($_SESSION['user_profile'] ?? '../../Images/default.jpg')) ?>" alt="admin-profile" id="admin-profile">
                ▾</button>
            <div id="admin-dropdown">
                <a href="../../profile.php">Profile</a>
                <form action="../../logout.php" method="post">
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>