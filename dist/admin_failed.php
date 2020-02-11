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
    <div class="mainContainer" style="text-align:center;">
        <?php require 'include/nav.php' ?>

        <h2>Failed!</h2>
        <hr>
        <p>Please ensure that the record is not being referenced within another table.</p>
        <button onclick="window.location.href = 'admin_panel.php'" class="button button--primary hvr-fade">Return</button>
    
        <?php require 'include/footer.php' ?>
    </div>
    
    <?php require 'include/script.php' ?>
</body>
</html>