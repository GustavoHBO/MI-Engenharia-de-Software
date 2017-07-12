 /*
  **********************************************************
  * OPAQUE NAVBAR SCRIPT
  **********************************************************
  */

  // Toggle tranparent navbar when the user scrolls the page

  $(window).scroll(function() {
    if($(this).scrollTop() > 200)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
        $('#logo').addClass('logo-ativo');
        $('#navMain li a').addClass('ativo');
    } else {
        $('.opaque-navbar').removeClass('opaque');
        $('#logo').removeClass('logo-ativo');
        $('#navMain li a').removeClass('ativo');
    }
});