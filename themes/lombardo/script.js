console.log(document);
var $ = jQuery.noConflict();

// $(function () {
//   //Post Readmore

//   var $length = document.querySelectorAll(".post-box").length;
//   //alert($length);
//   $(".post-box").slice(0, 5).css("display", "flex");

//   $("#loadMore").on("click", function (e) {
//     e.preventDefault();
//     //$(".post-box:hidden").slice(0, 2).slideDown();
//     $(".post-box:hidden").slice(0, 2).slideDown().css("display", "flex");

//     if ($(".post-box:hidden").length == 0) {
//       $("#loadMore").css("display", "none");
//     }
//   });

// });

function scrollToAnchor() {
  const hash = window.location.hash;

  if (hash) {
    const targetElement = document.querySelector(hash);
    if (targetElement) {
      targetElement.scrollIntoView({ behavior: "smooth" });
    }
  }
}

// Call the function on page load
window.onload = scrollToAnchor;

/*
   Preloaded (theme required) : ## LINK assets/theme/addon.js

   Default : 
        layout-style-remover | fancybox 4.0 | lazyload (verlok)
   If available : 
        match height | scroll up | owl slider (tick) | BS Gravity Form
   If clicked : 
        anchor | search pop
*/
