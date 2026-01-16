<?php
session_start();
require 'database.php';
$selectedCategory = $_GET['category'] ?? 'Classic';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add-to-cart'])) {
    $drinkId = $_POST['drink_id'];
    $drinkName = $_POST['drink_name'];
    $drinkPrice = $_POST['drink_price'];
    $drinkImage = $_POST['drink_image'];
    $drinkQty = $_POST['drink_qty'];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['drink_id'] == $drinkId) {
            $item['drink_qty'] += $drinkQty;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['cart'][] = [
            'drink_id' => $drinkId,
            'drink_name' => $drinkName,
            'drink_price' => $drinkPrice,
            'drink_image' => $drinkImage,
            'drink_qty' => $drinkQty
        ];
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>The Coffee Stop</title>
</head>

<body>
    <?php require('includes/header.php') ?>
    <div class="menuContainer">
        <div class="categoryContainer">

            <a href="menu.php?category=Classic"
                class="categoryItem <?= $selectedCategory === 'Classic' ? 'active' : '' ?>">
                Classic
            </a>

            <a href="menu.php?category=Top%20Picks"
                class="categoryItem <?= $selectedCategory === 'Top Picks' ? 'active' : '' ?>">
                Top Picks
            </a>

            <a href="menu.php?category=Coconut%20series"
                class="categoryItem <?= $selectedCategory === 'Coconut series' ? 'active' : '' ?>">
                Coconut Series
            </a>

            <a href="menu.php?category=Chocolate%20series"
                class="categoryItem <?= $selectedCategory === 'Chocolate series' ? 'active' : '' ?>">
                Chocolate
            </a>

            <a href="menu.php?category=Tea"
                class="categoryItem <?= $selectedCategory === 'Tea' ? 'active' : '' ?>">
                Tea
            </a>

            <a href="menu.php?category=Non-Coffee"
                class="categoryItem <?= $selectedCategory === 'Non-Coffee' ? 'active' : '' ?>">
                Non-Coffee
            </a>

            <a href="menu.php?category=Frappes"
                class="categoryItem <?= $selectedCategory === 'Frappes' ? 'active' : '' ?>">
                Frappes
            </a>

            <a href="menu.php?category=Pastries"
                class="categoryItem <?= $selectedCategory === 'Pastries' ? 'active' : '' ?>">
                Pastries
            </a>

            <a href="menu.php?category=Cakes"
                class="categoryItem <?= $selectedCategory === 'Cakes' ? 'active' : '' ?>">
                Cakes
            </a>

        </div>
        <div class="itemsContainer">
            <?php
            $query = 'SELECT d.* FROM Drinks d JOIN Categories c ON d.categories_id = c.categories_id WHERE c.categories_name = ?';
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $selectedCategory);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="menuItem">
                    <img src="<?= htmlspecialchars($row['drinks_image']) ?>"
                        alt="<?= htmlspecialchars($row['drinks_name']) ?>">
                    <h3><?= htmlspecialchars($row['drinks_name']) ?></h3>
                    <button class="openModal" data-drinks-id="<?= $row['drinks_id'] ?>"
                        data-drinks-name="<?= htmlspecialchars($row['drinks_name']) ?>"
                        data-drinks-image="<?= htmlspecialchars($row['drinks_image']) ?>"
                        data-drinks-description="<?= htmlspecialchars($row['drinks_description']) ?>"
                        data-drinks-price="<?= htmlspecialchars($row['drinks_price']) ?>">View Details -></button>
                </div>
            <?php endwhile; ?>
        </div>
        <?php mysqli_stmt_close($stmt); ?>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>
                <div id="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="add-tocart-form">

                        <h2 id="modal-drinks-name"></h2>
                        <img id="modal-drinks-image" src="" alt="">
                        <p id="modal-drinks-description"></p>
                        <p id="modal-drinks-price"></p>


                        <input type="hidden" id="drink-id-input" name="drink_id" value="">
                        <input type="hidden" id="drink-name-input" name="drink_name" value="">
                        <input type="hidden" id="drink-price-input" name="drink_price" value="">
                        <input type="hidden" id="drink-image-input" name="drink_image" value="">
                        <input type="hidden" id="drink-quantity-input" name="drink_qty" value="1">

                        <div id="quantity-control">
                            <button type="button" id="decrease-qty-btn">-</button>
                            <span id="quantity"></span>
                            <button type="button" id="increase-qty-btn">+</button>
                        </div>

                        <input type="submit" id="add-to-cart-btn" name="add-to-cart" value="Add to Cart">
                    </form>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </div>
    <?php require('includes/footer.php') ?>

</body>

</html>