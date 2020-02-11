<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Checkout</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="successHeader spaceTop">
             <h2>Success!</h2>
             <hr>
             <p>We will contact you shortly via email.</p>
             <button class="button button--primary hvr-fade" onclick="window.location.href = 'index.php'" style="margin-top: 1em;">Return</button>
        </header>

        <?php require 'include/footer.php' ?>
    </div>
    
    <?php require 'include/script.php' ?>
</body>
</html>