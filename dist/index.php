<?php require 'include/session.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>GetMobile</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="mainHeader spaceTop">
            <div class="mainHeader__info">
                <h2>Your Source for Affordable Phones and Accessories</h2>

                <p>We have everything from the latest and greatest phones to the more reasonable choices from all major cellular providers.</p>
                <p>Purchasing a phone/accessory has never been easier! Simply navigate to the store page and add items that you would like to purchase to your cart.</p>
                <p>Deliveries take 1-3 working days to reach you!</p>
            </div>

            <div class="mainHeader__image">
                <img src="img/main_image.jpg" alt="">
            </div>
        </header>

        <div class="mainContent spaceTop">
  
        <figure class="imghvr-fade">
            <img src="img/android.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Android Phones</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/apple.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>IOS Phones</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/watches.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Watches</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/cases.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Phone Cases</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/charger.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Chargers</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/wireless_charger.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Wireless Chargers</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/earphones.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Earhpones</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        <figure class="imghvr-fade">
            <img src="img/wireless_earphones.jpg">
            <figcaption style="text-align: center; background-color: rgba(0, 0, 0, 0.5);">
                <h2>Wireless Earphones</h2>
            </figcaption>
            <a href="products.php"></a>
        </figure>
        </div>

        <?php require 'include/footer.php' ?>
    </div>

    <?php require 'include/script.php' ?>
</body>
</html>