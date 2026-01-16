<?php
session_start();
include('database.php');

if (!isset($_SESSION['user-id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
}

if (isset($_POST['remove-cart-item'])) {
    $drinkIdtoRemove = $_POST['drink_id'];
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['drink_id'] == $drinkIdtoRemove) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
}

if (isset($_POST['increase-qty'])) {
    $selectedDrink = $_POST['drink-qty'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['drink_id'] == $selectedDrink) {
            $item['drink_qty']++;
            break;
        }
    }
    unset($item);
}

if (isset($_POST['decrease-qty'])) {
    $selectedDrink = $_POST['drink-qty'];

    foreach ($_SESSION['cart'] as $index => &$item) {
        if ($item['drink_id'] == $selectedDrink) {

            if ($item['drink_qty'] > 1) {
                $item['drink_qty']--;
            } else {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }

            break;
        }
    }

    unset($item);
}

if (isset($_POST['checkout'])) {
    if (isset($_SESSION['username'])) {
        if (empty($_SESSION['cart'])) {
            header("Location: cart.php?");
            exit;
        }
        $_SESSION['checkout'] = [];

        // create a checkout list that stores cart item
        foreach ($_SESSION['cart'] as $item) {
            $_SESSION['checkout'][]  = $item;
        }
        header("Location: checkout.php");
    } else {
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Cart</title>
</head>

<body>
    <?php require('includes/header.php') ?>
    <div id="cartContainer">
        <h1>Shopping Cart</h1>
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <table id="cart-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $item):
                        $itemTotal = $item['drink_qty'] * $item['drink_price'];
                        $grandTotal += $itemTotal; ?>
                        <tr>
                            <td><?= htmlspecialchars($item['drink_name']) ?></td>
                            <td><img src="<?= htmlspecialchars($item['drink_image']) ?>" alt="<?= htmlspecialchars($item['drink_name']) ?>"></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="drink-qty" value="<?= $item['drink_id'] ?>">
                                    <button name="decrease-qty" id="drink-decrease-btn">-</button>
                                    <span><?= htmlspecialchars($item['drink_qty']) ?></span>
                                    <button name="increase-qty" id="drink-increase-btn">+</button>
                                </form>
                            </td>
                            <td>$<?= htmlspecialchars($item['drink_price']) ?></td>
                            <td>$<?= number_format($itemTotal, 2) ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="drink_id" value="<?= $item['drink_id'] ?>">
                                    <button id="remove-item-btn" name="remove-cart-item">Remove item</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4" style="text-align: right;"><strong>Grand Total:</strong></td>
                        <td><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
        <form method="post" id="operation">
            <button id="clear-cart-btn" name="clear_cart">Clear Cart</button>
            <button id="checkout-btn" name="checkout">Checkout</button>
        </form>
    </div>
    <?php require('includes/footer.php') ?>
</body>

</html>