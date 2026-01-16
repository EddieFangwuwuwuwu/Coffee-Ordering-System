<?php
session_start();
include('database.php');

if (!isset($_SESSION['user-id']) || !isset($_POST['order_id'])) {
    header("Location: order.php");
    exit;
};

$userId = $_SESSION['user-id'];
$orderId = $_POST['order_id'];
$query = "SELECT oi.drinks_name, oi.drinks_image, oi.quantity, oi.price FROM orderitems oi JOIN orders o ON oi.order_id = o.order_id WHERE oi.order_id = ? AND o.user_id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $orderId, $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>

<body id="order-detail">
    <?php include('includes/header.php') ?>
    <div id="order-detail-container">
        <h1>Order Details</h1>
        <h3>Order <?= htmlspecialchars($orderId) ?></h3>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($item = mysqli_fetch_assoc($result)): ?>
                <div class="order-item-container">
                    <img src="<?= htmlspecialchars($item['drinks_image']) ?>" alt="">
                    <div class="order-item-desc">
                        <p><?= htmlspecialchars($item['drinks_name']) ?></p>
                        <p>Qty: <?= (int) $item['quantity'] ?></p>
                        <p>Price: $<?= number_format($item['price'], 2) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No items found for this order.</p>
        <?php endif; ?>
    </div>
    <?php include('includes/footer.php') ?>
</body>

</html>