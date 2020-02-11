<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Payment</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <div class="form spaceTop">
            <div class="info">
                <h2>Payment</h2>
                <p>Please fill out the following to process payment.</p>
                <img src="img/mastercard.jpg" alt="">
            </div>

            <form id="paymentForm" name="paymentForm" onsubmit="return validateForm()" method="post">
                <input name="cardName" id="holderName" onfocusout="validInput(this)" type="text" placeholder="card holder name...">
                <span></span>
                <input name="cardNumber" type="text" pattern="\d*" maxlength="16" onfocusout="validInput(this)" placeholder="card number...">
                <span></span>
                <input class="cvc" type="text" pattern="\d*" maxlength="3" name="cardCVC" onfocusout="validInput(this)" placeholder="CVC">
                <span></span>
                <input name="cardAddress" onfocusout="validInput(this)" type="text" placeholder="card holder address...">
                <span></span>
                <button class="submit" type="submit" name="submit">Pay</button>
            </form>
        </div>

        <img class="spaceTop" style="width: 100%" src="img/login.jpg" alt="">
        <?php require 'include/footer.php' ?>
    </div>

    <script type="text/javascript">

var myForm = document.getElementById("paymentForm");

function checkout() 
{
    $.getJSON("request/checkout.php",

        function(data){
          if (data == 0)
          {
            alert("You must be logged in to remove items to cart!");
          }
          else if (data == 1)
          {
            window.location = 'success.php';
          }
          else {
            alert("Something went wrong...")
          }
        });
}

function validInput(input)
{
  var valid = true;
  var errorMessage = '';
  input.nextElementSibling.setAttribute("style", "");
  if(isEmpty(input.value))
  {
    input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
    if(input.name == 'cardName')
    input.nextElementSibling.innerHTML = "Name is required!";
    else if(input.name == 'cardNumber')
    input.nextElementSibling.innerHTML = "Card number is required!";
    else if(input.name == 'cardCVC')
    input.nextElementSibling.innerHTML = "CVC is required!";
    else if(input.name == 'cardAddress')
    input.nextElementSibling.innerHTML = "Address is required!";
    return false;
  }
  else
  {
    switch (input.name)
    {
      case 'cardNumber':
      {
        if(input.value.toString().length < 16)
        {
            errorMessage = 'Card number is too short!';
            valid = false;
        }

      } break;
      case 'cardCVC':
      {
        if(input.value.toString().length < 3)
        {
            errorMessage = 'CVC is too short!';
            valid = false;
        }
      } break;
    }

    if (!valid)
    {
      input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
      input.nextElementSibling.innerHTML = errorMessage;
      return valid;
    }
    else
    {
      input.setAttribute("style", "background-color:#fafafa; border-color:#ccc");
      input.nextElementSibling.innerHTML = '';
      return valid
    }
  }


}


function validateForm()
{
  var valid = false;
  var cardName = document["paymentForm"]["cardName"];
  var cardNumber = document["paymentForm"]["cardNumber"];
  var cardCVC = document["paymentForm"]["cardCVC"];
  var cardAddress = document["paymentForm"]["cardAddress"];

  if(validInput(cardName)
  & validInput(cardNumber)
  & validInput(cardCVC)
  & validInput(cardAddress))
  {
    valid = false;
    checkout();
  }
  return valid;
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function isEmpty(str)
{
  return !str.replace(/\s+/, '').length;
}

</script>
    <?php require 'include/script.php' ?>
</body>
</html>