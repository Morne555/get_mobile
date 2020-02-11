<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>About</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="aboutHeader spaceTop">
            <h2>About Us</h2>
        </header>

        <main class="about spaceTop">
            <div class="contentLight">
                <h3 class="">Who are we?</h3>
                <img src="img/who_are_we.jpg" alt="">
                <div class="info">
                    <p>We offer a wide range of mobile phones and accessories which all can be purchased online!</p>
                    <p>GetMobile is a relatively new company and is looking to shake up the market by offering far better deals.</p>
                </div>
            </div>
            <div class="contentDark">
                <h3>What we strive for</h3>
                <img src="img/what_we_strive_for.jpg" alt="">
                <div class="info">
                    <p>We strive to offer only the fairest of deals for our consumers.</p>
                    <p>We promise to treat our customers fairly and ensure the upmost quality of services.</p>
                    <p>For the future, we would like to expand our product range even further.</p>
                </div>
            </div>
            <div class="contentLight">
                <h3>Our policies</h3>
                <img src="img/our_policies.jpg" alt="">
                <div class="info">
                    <p>All deliveries will take 1-3 working days. We do NOT work on public holidays!</p>
                    <p>We currently are exclusively using FedEx as our courier with a flat rate of 2% for delivery fees.</p>
                    <p>Items shipped from GetMobile may be returned within 30 days of receipt of shipment.</p>
                </div>
            </div>
        </main>

        <?php require 'include/footer.php' ?>
    </div>
    
    <?php require 'include/script.php' ?>
</body>
</html>