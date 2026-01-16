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
    <?php require './includes/header.php' ?>
    <div class="auContainer1">
        <video autoplay loop muted id="auContainer1Video">
            <source src="./Images/aboutUsauContainer2.mp4" type="video/mp4">
        </video>
        <h2>At The Coffee Stop, we believe coffee is more than just a drink — it’s a pause in your day. A place to slow down, refocus, and enjoy a moment of comfort with a good cup of coffee.</h2>
    </div>
    <div class="auContainer2">
        <div class="auContainer2textContainer">
            <h2>Our café was created as a cozy space where students can study, professionals can work, and couples can unwind together. Whether you’re here to concentrate, have a quiet conversation, or simply enjoy some time to yourself, The Coffee Stop is designed to make you feel comfortable and at ease.</h2>
        </div>
        <img src="./Images/working.png" alt="a man is working">
    </div>
    <div class="auContainer3">
        <h2>We serve carefully brewed coffee made from quality beans, ensuring every cup is smooth, balanced, and satisfying. From your morning boost to an afternoon break, our goal is to provide coffee you can rely on — consistently good, every time.</h2>
        <video autoplay loop muted id="auContainer3Video">
            <source src="./Images/CoffeeBrewing - Made with Clipchamp.mp4" type="video/mp4">
        </video>
    </div>
    <div class="auContainer4">
        <h3>With warm lighting, comfortable seating, and a calm atmosphere, The Coffee Stop is more than a café — it’s a place to stay, focus, and connect.</h3>
        <div class="auContainer4ImagesContainer">
            <div class="imgContainer">
                <img src="./Images/relax.png" alt="relaxing">
                <p>Take a break.</p>
            </div>
            <div class="imgContainer">
                <img src="./Images/breath.png" alt="relaxing">
                <p>Take a breath.</p>
            </div>
            <div class="imgContainer">
                <img src="./Images/drink.png" alt="relaxing">
                <p>Take a Coffee Stop.</p>
            </div>
        </div>
    </div>
    <?php require "./includes/footer.php" ?>
</body>

</html>