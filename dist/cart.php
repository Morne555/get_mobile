<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Cart</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="cartHeader spaceTop">
            <h2>Cart</h2>
            <hr>
        </header>

        <main class="catalog">
            <div class="container">
                
            </div>
            <hr class="spaceTop">
            <div class="total">
            </div>
            <hr>
        </main>
    
        <?php require 'include/footer.php' ?>
    </div>
    <?php require 'include/script.php' ?>
    <script>
function commafy( num ) {
    var str = num.toString().split('.');
    if (str[0].length >= 5) {
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    if (str[1] && str[1].length >= 5) {
        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }
    return str.join('.');
}

function checkout() 
{
  window.location = 'payment.php';
}

function removeCart(id) {
  $.getJSON("request/remove_cart.php",
        {
          product_id: id
        },
        function(data){
          if (data == 0)
          {
            alert("You must be logged in to remove items to cart!");
          }
          else if (data == 1)
          {
            $( ".product" ).remove( );
            $( ".total" ).empty( );
            loadCart();
          }
          else {
            alert("Something went wrong...")
          }
        });
}

function loadCart()
{
    $.getJSON("request/load_cart.php",
            {
            category: "all",
            subCategory: "all",
            priceMin: "all",
            priceMax: "all",
            search: "all"
            },
            function(data){
            content = '';
            end = '';
            var total = 0;
            if (data == 0)
            {
                $('<h3 style="grid-column: 1 / span 4; text-align: center">Your cart is currently empty...<h3>').appendTo(".catalog .container");
            }
            else
            {


            data = 
            $.each(data.products, function(i,product){
                total += product.product_price;
                content += '<div class="product hvr-grow"><div class="thumbnail"><img src="img/' + product.product_image + '" alt=""></div>';
                content += '<div class="caption"><h3>'+ product.product_name + '</h3>';
                content += '<p>' + product.product_description + '</p>';
                content += '<h3>R' + commafy(product.product_price) + '</h3>';
                content += '<button class="button button--warning hvr-fade" id="' + product.product_id + '" onclick="removeCart(this.id)">Remove</button>  </div> </div>';
                content += '</div>';
                })
                
                var shipping = 0;

                shipping = total * 0.02;
                var grandTotal = shipping + total;
                end += '<div class="container"><h3 style="padding-top:0;">Total: R' + commafy(total) + '</h3> '
                end += '<h3>Shipping (2%): R' + commafy(shipping) + '</h3> '
                end += '<hr><h3 style="font-weight: bold;">Grand Total: R' + commafy(grandTotal) + '</h3>';
                end += '<button class="button button--success hvr-fade" onclick="checkout()">Checkout</button></div>';
            $(content).appendTo(".catalog .container");
            $(end).appendTo(".catalog .total");
        }

    });
}

loadCart();
</script>

</body>
</html>