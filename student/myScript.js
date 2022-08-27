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

//sidebar
$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });
});