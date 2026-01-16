<?php
session_start();
include('database.php');

if(isset($_POST['viewOrderDetail'])){
    header("Location: orderDetail.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Order</title>
</head>

<body id="order-page">
    <?php include('includes/header.php'); ?>
    <h1 id="order-title">My Order</h1>
    <?php
    // retrieve orders using foreach loop
    $userId = $_SESSION['user-id'];
    $query = "SELECT order_id, order_date, total_price FROM orders WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($order = mysqli_fetch_assoc($result)): ?>
        <div class="order-container">
            <h3>Order #<?= htmlspecialchars($order['order_id']) ?></h3>
            <p><?= htmlspecialchars($order['order_date']) ?></p>
            <p><strong>Total</strong> <?= htmlspecialchars($order['total_price']) ?></p>
            <form method="post" action="orderDetail.php">
                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id'])?>">
                <button class="view-order-btn" name="viewOrderDetail" ?>>View More</button>
            </form>
        </div>
    <?php endwhile; ?>
    <?php include('includes/footer.php'); ?>
</body>

</html>