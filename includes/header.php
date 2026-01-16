<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <section>
        <section id="container1">
            <h1>The Coffee Stop</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../abouts.php">About</a></li>
                    <li id="menu">
                        <a href="../menu.php">Menu</a>
                        <div id="dropdown">
                            <a href="">Classic</a>
                            <a href="">Tea</a>
                            <a href="">Coconut Series</a>
                            <a href="">Chocolate</a>
                            <a href="">Kids-friendly</a>
                            <a href="">pastries</a>
                        </div>
                    </li>
                    <li><a href="../contactUs.php">Contact us</a></li>
                </ul>
            </nav>
        </section>
        <section id="container2">
            <a href="../cart.php" id="cart">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 640 640">
                    <path d="M0 72C0 58.7 10.7 48 24 48L69.3 48C96.4 48 119.6 67.4 124.4 94L124.8 96L524.7 96C549.8 96 568.7 118.9 564 143.6L537.6 280.6C529.6 322 493.4 352 451.2 352L171.4 352L176.5 380.3C178.6 391.7 188.5 400 200.1 400L456 400C469.3 400 480 410.7 480 424C480 437.3 469.3 448 456 448L200.1 448C165.3 448 135.5 423.1 129.3 388.9L77.2 102.6C76.5 98.8 73.2 96 69.3 96L24 96C10.7 96 0 85.3 0 72zM162.6 304L451.2 304C470.4 304 486.9 290.4 490.5 271.6L514.9 144L133.5 144L162.6 304zM208 480C234.5 480 256 501.5 256 528C256 554.5 234.5 576 208 576C181.5 576 160 554.5 160 528C160 501.5 181.5 480 208 480zM432 480C458.5 480 480 501.5 480 528C480 554.5 458.5 576 432 576C405.5 576 384 554.5 384 528C384 501.5 405.5 480 432 480z" />
                </svg>
            </a>
            <?php if (isset($_SESSION['username'])): ?>
                <div class="user-menu">
                    <button class="user-trigger">
                        <?= htmlspecialchars($_SESSION['username']) ?>
                        ▾
                    </button>
                    <div class="user-dropdown">
                        <a href="../profile.php">Profile</a>
                        <a href="../order.php">My Orders</a>
                        <hr>
                        <form action="../logout.php" method="post">
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a id="login" href="login.php">
                    Login
                    <svg id="loginIcon"
                        xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black">
                        <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z" />
                    </svg>
                </a>
            <?php endif; ?>
        </section>
    </section>

</header>