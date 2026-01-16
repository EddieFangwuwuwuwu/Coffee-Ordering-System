<?php
session_start();
include('database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Document</title>
</head>

<body>
    <?php require('includes/header.php'); ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="feedback-form">
        <h2>Contact Us</h2>
        <p>Your feedback means a lot to us. It helps us keep improving our service for you.</p>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5"></textarea>
        <input type="submit" value="Submit">
    </form>
    <?php require('includes/footer.php'); ?>
</body>

</html>