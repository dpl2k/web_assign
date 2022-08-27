var goUp = document.getElementById("backtotop");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    goUp.style.display = "block";
  } else {
    goUp.style.display = "none";
  }
}
function topFunction() {
  window.scrollTo(0, 0);
}

///////////////////
$(".navbar a").click(function() {  
  //remove all active class from a elements
  $("a").removeClass("active");
  $(this).addClass("active");      //add the class to the clicked element
});

//////////////
/*Automatic slide */
$(document).ready(function(){
  // Activate Carousel with a specified interval
  $("#myCarousel").carousel({interval: 2000}); 
  
  // Enable Carousel Indicators
  $(".item1").click(function(){
      $("#myCarousel").carousel(0);
  });
  $(".item2").click(function(){
      $("#myCarousel").carousel(1);
  });
  $(".item3").click(function(){
      $("#myCarousel").carousel(2);
  });
      
  // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
      $("#myCarousel").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
      $("#myCarousel").carousel("next");
  });
});


