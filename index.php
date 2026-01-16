<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>The Coffee Stop</title>
</head>

<body>
    <?php require 'includes/header.php'; ?>
    <div class="carousel">
        <div class="descriptionContainer">
            <p id="description">Try our new iced ceo coconut latte</p>
            <button id="purchaseButton"><a href="">Click to view more</a></button>
        </div>
        <div class="image">
            <img id="coconut-latte" src="./Images/Iced-CEO-Coconut-Latte.png" alt="coconut latte">
        </div>
    </div>
    <div class="carousel2">
        <div class="slogan">Brewed to Perfection,</div>
        <div class="slogan">Crafted for you</div>
    </div>
    <div class="carousel3">
        <h1>Customer Review</h1>
        <div class="customerReviewContainer">
            <div class="customerReview">
                <img src="./Images/caixukun.png" alt="customer1">
                <p>Xu Kun</p>
                <p class="stars">⭐⭐⭐⭐</p>
                <p class="review">"Great coffee with a nice aroma. A little strong for my taste, but overall very enjoyable. Friendly staff too!"</p>
            </div>
            <div class="customerReview">
                <img src="./Images/user1.jpeg" alt="customer1">
                <p>Orange</p>
                <p class="stars">⭐⭐⭐⭐⭐</p>
                <p class="review">"The best latte I’ve had in ages! The barista really knows their craft. Cozy atmosphere and fast service. Highly recommend!"</p>
            </div>
            <div class="customerReview">
                <img src="./Images/user2.jpeg" alt="customer1">
                <p>Steve Hong</p>
                <p class="stars">⭐⭐⭐⭐⭐</p>
                <p class="review">"Absolutely loved this coffee! Rich, smooth, and full of flavor. Perfect pick-me-up in the morning. Will definitely order again!"</p>
            </div>
        </div>
    </div>
    <div class="carousel4">
        <div class="JoinUs">
            <h1>Join Us as member and </h1>
        </div>
        <div class="bannerContainer">
            <div class="imgBanner">
                <img id="freeCoffee" src="./Images/freeCoffee.png" alt="freeCoffee">
                <img id="sprinkles" src="./Images/sprinkles.png" alt="sprinkles">
            </div>
            <div class="banner">
                <h1>And get a FREE DRINK from us</h1>
                <button id="signUpButton"><a href="">Sign Up Now</a></button>
            </div>
        </div>
    </div>
    <?php require 'includes/footer.php' ?>
</body>

</html>