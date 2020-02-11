<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Contact</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <div class="contact spaceTop">
            <div class="info">
                <h2>Contact Details</h2>
                <label for="">Physical Address:</label>
                    <br>
                    <span>Cnr Orpen Rd &#38; Letaba Rd<br> Oakdene, 2001</span>
                    <br>
                    <br>
                    <label for="">Postal Address:</label>
                    <br>
                    <span>P.O Box 12345<br>Gleneagles<br> 4234</span>
                    <br>
                    <br>
                    <label for="">Contact Numbers:</label>
                    <br>
                    <span>Tel: (011) 832-3245 <br> Fax:(011) 832-1234</span>
                    <br>
                    <br>
                    <label for="">Web and e-mail:</label>
                    <br>
                    <span><a class="blueLink" href="index.php">http://getmobile.co.za<br></a><a class="blueLink" href="mailto:sales@getMobile.co.za">sales@getmobile.co.za</a></span>
                    <br>
                    <br>
                    
                    <form id="emailForm" name="emailForm" action="email_success.php"  onsubmit="return validateEmail()">
                        <input name="email" id="email" type="text" placeholder="We can contact you via email...">
                        <span></span>
                        <button name="submit" type="submit" class="submit button button--primary hvr-fade">Submit</button>
                    </form>
            </div>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3577.779660039985!2d28.049790515031404!3d-26.268813683409178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e950f6e419739ef%3A0x77cc1929d0be174d!2sLetaba+Rd+%26+Orpen+Rd%2C+Eastcliff%2C+Johannesburg+South%2C+2190!5e0!3m2!1sen!2sza!4v1565520639511!5m2!1sen!2sza" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        
        <div class="officePictures spaceTop">
            <img class="" src="img/office.jpg" alt="">
            <img class="" src="img/office_room.jpg" alt="">
        </div>
    
        <script>
            function validateEmail() {
                var email = document.getElementById("email");
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (!regex.test(email.value))
                {
                    email.nextElementSibling.innerHTML = "Invalid Email!";

                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script>

        <?php require 'include/footer.php' ?>
    </div>
    
    <?php require 'include/script.php' ?>
</body>
</html>