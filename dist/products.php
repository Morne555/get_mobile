<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Products</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="productHeader spaceTop">
            <h2>Products</h2>
        </header>

        <div class="filter">
            <div class="catergory">
                <h3>Category</h3>
                    <div class="field"><input id="phone" type="checkbox" onclick="getCatalog()"><label for="">Phones</label></div>
                    <div class="field"><input id="charger" type="checkbox" onclick="getCatalog()"><label for="">Chargers</label></div>
                    <div class="field"><input id="earphone" type="checkbox" onclick="getCatalog()"><label for="">Earphones</label></div>
                    <div class="field"><input id="cases" type="checkbox" onclick="getCatalog()"><label for="">Cases</label></div>
                    <div class="field"><input id="watches" type="checkbox" onclick="getCatalog()"><label for="">Watches</label></div>
            </div>
            <div class="subCategory">
                <h3>Sub-Category</h3>
                <div class="field"><input id="ios" type="checkbox" onclick="getCatalog()"><label for="">Apple</label></div>
                <div class="field"><input id="android" type="checkbox" onclick="getCatalog()"><label for="">Android</label></div>
            </div>
            <div class="price">
                <h3>Price</h3>
                <div class="container">
                    <h4>Range: (R)</h4>
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                        <input type="number" min=0 max="19000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
                        <input type="number" min=0 max="20000" oninput="validity.valid||(value='20000');" id="max_price" class="price-range-field" />
                    </div>
                </div>
            <div class="search">
                <h3>Search</h3>
                <input id="search" type="search" oninput="doSearch()" placeholder="What are you looking for?">
            </div>
        </div>

        <main class="catalog spaceTop">
        <div class="container">
            
            
        </div>
    </main>

    </div>


    <?php require 'include/footer.php' ?>
    
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

function addCart(id) {
  $.getJSON("request/add_cart.php",
        {
          product_id: id
        },
        function(data){
          if (data == 0)
          {
            alert("You must be logged in to add items to cart!");
          }
          else if (data == 1)
          {
            alert("Item was added to cart.");
          }
          else {
            alert("Something went wrong...");
          }
        });
}


var delayTimer;
function doSearch() {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
      getCatalog();
    }, 1000); // Will do the ajax stuff after 1000 ms, or 1 s
}

getCatalog();

function getCatalog() 
{

  $( ".product" ).remove( );

  CATEGORY = 0;
  SUB_CATEGORY = 0;

  var phone = document.getElementById("phone");
  if (phone.checked) CATEGORY = CATEGORY | 1;
  
  var charger = document.getElementById("charger");
  if (charger.checked) CATEGORY = CATEGORY | 2;

  var earphone = document.getElementById("earphone");
  if (earphone.checked) CATEGORY = CATEGORY | 4;

  var cases = document.getElementById("cases");
  if (cases.checked) CATEGORY = CATEGORY | 8;

  var watches = document.getElementById("watches");
  if (watches.checked) CATEGORY = CATEGORY | 16;

  var ios = document.getElementById("ios");
  if (ios.checked) SUB_CATEGORY = SUB_CATEGORY | 1;

  var android = document.getElementById("android");
  if (android.checked) SUB_CATEGORY = SUB_CATEGORY | 2;

  var searchInput = document.getElementById("search");
  
  $.getJSON("request/load_products.php",
        {
        category: CATEGORY,
        subCategory: SUB_CATEGORY,
        priceMin: $('#min_price').val(),
        priceMax: $('#max_price').val(),
        search: searchInput.value
        },
        function(data){
          content = '';
          data = 
          $.each(data.products, function(i,product){
            content += '<div class="product hvr-grow"><div class="thumbnail"><img src="img/' + product.product_image + '" alt=""></div>';
            content += '<div class="caption"><h3>'+ product.product_name + '</h3>';
            content += '<p>' + product.product_description + '</p>';
            content += '<div class="end"><h3>R' + commafy(product.product_price) + '</h3>';
            content += '<button class="button button--primary hvr-fade" id="' + product.product_id + '" onclick="addCart(this.id)">Add to cart</button>  </div> </div>';
            content += '</div>';
            });
          $(content).appendTo(".catalog .container");
        });
}


  




$(document).ready(function(){
	
	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {

	  $('#price-range-submit').show();

	  var min_price_range = parseInt($("#min_price").val());

	  var max_price_range = parseInt($("#max_price").val());

	  if (min_price_range > max_price_range) {
		$('#max_price').val(min_price_range);
	  }

	  $("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });
	  
	});


	$("#min_price,#max_price").on("paste keyup", function () {                                        

	  $('#price-range-submit').show();

	  var min_price_range = parseInt($("#min_price").val());

	  var max_price_range = parseInt($("#max_price").val());
	  
	  if(min_price_range == max_price_range){

			max_price_range = min_price_range + 100;
			
			$("#min_price").val(min_price_range);		
			$("#max_price").val(max_price_range);
	  }

	  $("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });

	});
  
	$(function () {
	  $("#slider-range").slider({
		range: true,
		orientation: "horizontal",
		min: 0,
		max: 20000,
		values: [0, 20000],
		step: 100,

		slide: function (event, ui) {
		  if (ui.values[0] == ui.values[1]) {
			  return false;
		  }
		  
		  $("#min_price").val(ui.values[0]);
		  $("#max_price").val(ui.values[1]);
		}
	  });

	  $("#min_price").val($("#slider-range").slider("values", 0));
	  $("#max_price").val($("#slider-range").slider("values", 1));

	});

	$("#slider-range,#price-range-submit").click(function () {

	  var min_price = $('#min_price').val();
	  var max_price = $('#max_price').val();

	  $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
	});

    $( "#slider-range" ).slider({
   stop: function(event, ui) { 
       console.log("pressed");
       getCatalog();
    }
    });
});
</script>
</body>
</html>