<?php
session_start();
include('database.php');

if (isset($_SESSION['user-id'])) {
    $query = 'SELECT user_name, user_email FROM users WHERE user_id = ?';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user-id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        $message = 'user not found';
    }
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    if (empty($_SESSION['checkout'])) {
        $error = "Cart is empty";
        return;
    }

    if (!isset($_POST['shipping'], $_POST['payment'])) {
        $error = "Shipping and payment required";
        return;
    }

    $user_id  = $_SESSION['user-id'];
    $shipping = $_POST['shipping'];
    $payment  = $_POST['payment'];
    $remark   = $_POST['remark'] ?? '';

    $grandTotal = 0;
    foreach ($_SESSION['checkout'] as $item) {
        $grandTotal += $item['drink_price'] * $item['drink_qty'];
    }

    mysqli_begin_transaction($conn);

    try {
        $query = "INSERT INTO orders (user_id, total_price, shipping, payment, remark)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            'idsss',
            $user_id,
            $grandTotal,
            $shipping,
            $payment,
            $remark
        );
        mysqli_stmt_execute($stmt);

        $order_id = mysqli_insert_id($conn);

        $query = "INSERT INTO orderitems (order_id, drinks_id, drinks_name, drinks_image, price, quantity)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        foreach ($_SESSION['checkout'] as $item) {
            mysqli_stmt_bind_param(
                $stmt,
                'iissdi',
                $order_id,
                $item['drink_id'],
                $item['drink_name'],
                $item['drink_image'],
                $item['drink_price'],
                $item['drink_qty']
            );
            mysqli_stmt_execute($stmt);
        }

        mysqli_commit($conn);

        unset($_SESSION['checkout']);
        header("Location: order.php");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $error = "Checkout failed. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Checkout</title>
</head>

<body id="checkout-page">
    <?php require('includes/header.php') ?>
    <div id="checkout-container">
        <div id="checkout-information">
            <h1>Checkout</h1>
            <h2>Shipping Information</h2>
            <div id="option-group">
                <input type="radio" name="shipping" id="pick-up" value="Pick Up" form="checkout-form">
                <label for="pick-up" class="option-card">Pick Up</label>
                <input type="radio" name="shipping" id="delivery" value="Delivery" form="checkout-form">
                <label for="delivery" class="option-card">Delivery</label>
            </div>
            <hr>
            <div id="user-information-container">
                <h2>User Information</h2>
                <?php if ($user): ?>
                    <p><?= htmlspecialchars($user['user_name']) ?></p>
                    <p><?= htmlspecialchars($user['user_email']) ?></p>
                <?php else: ?>
                    <p><?= htmlspecialchars($message) ?></p>
                <?php endif ?>
            </div>
            <hr>
            <div id="payment-method">
                <h2>Payment Method</h2>
                <form id="checkout-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <div class="payment-option">
                        <input id="tng" type="radio" name="payment" value="touch-n-go" form="checkout-form">
                        <label for="tng" class="payment-card">Touch N Go</label>
                    </div>
                    <div class="payment-option">
                        <input id="ob" type="radio" name="payment" value="online-banking" form="checkout-form">
                        <label for="ob" class="payment-card">Online Banking</label>
                    </div>
                    <div class="payment-option">
                        <input id="cd" type="radio" name="payment" value="credit-debit-card" form="checkout-form">
                        <label for="cd" class="payment-card">Credit/Debit Card</label>
                    </div>
                    <div class="payment-option">
                        <input id="c" type="radio" name="payment" value="cash" form="checkout-form">
                        <label for="c" class="payment-card">Cash</label>
                    </div>
                </form>
                <div id="remark-container">
                    <h2>Remark</h2>
                    <textarea rows="5" cols="30" name="remark" form="checkout-form"></textarea>

                </div>
            </div>
        </div>
        <div id="cart-info-container">
            <h2>Review Your Cart</h2>
            <?php $grandTotal = 0;
            if (isset($_SESSION['checkout']) && !empty($_SESSION['checkout'])): ?>
                <?php foreach ($_SESSION['checkout'] as $item):
                    $total = $item['drink_qty'] * $item['drink_price'];
                    $grandTotal += $total ?>
                    <div class="cart-item-container">
                        <div class="cart-item-img">
                            <img src="<?= htmlspecialchars($item['drink_image']) ?>" alt="<?= htmlspecialchars($item['drink_name']) ?>">
                        </div>
                        <div class="cart-item-info">
                            <p><?= htmlspecialchars($item['drink_name']) ?></p>
                            <p><?= htmlspecialchars($item['drink_price']) ?></p>
                            <p><?= htmlspecialchars($item['drink_qty']) ?>x</p>
                            <strong><?= $total ?></strong>
                        </div>

                    </div>
                    <hr>
                <?php endforeach ?>
                <div id="display-total">
                    <h3>Total</h3>
                    <h3><?= number_format($grandTotal, 2) ?></h3>
                </div>
                <input type="submit" name="checkout" value="checkout" form="checkout-form">
                <?php if (!empty($error)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

            <?php endif ?>
        </div>
    </div>
    <?php require('includes/footer.php') ?>
</body>

</html>