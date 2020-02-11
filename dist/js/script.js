$(".submit").on("click", function() {
    $(this).addClass("shake");
  
    var delay = setTimeout(function(){
      $(".shake").removeClass("shake");
    }, 3000)
  });