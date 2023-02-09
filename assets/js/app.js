
    navbar = $('.navbar-nav'),
    navbarHeight = 80,
    // All list items
    navbarItems = navbar.find('li > a');

$(document).ready(function(){

  //Smooth scrooling to anchor or redirect to link if anchor doesnt exists
  navbarItems.click(function(e){
    e.preventDefault();
    //hide dropdown menu
    $('#navbarScroll').removeClass('show');
    navbarItems.removeClass('active');
    $(this).addClass('active');
    var href = $(this).attr('href');    
    
    window.scrollTo({
      top: document.querySelector(href).offsetTop - navbarHeight,
      behavior: 'smooth',
      
    });
    
    
  });

  $(window).on('scroll', function(){
    let position = window.scrollY;
    if(position > 10)
     $('.sticky-wrapper').addClass('is-sticky');
    else
      $('.sticky-wrapper').removeClass('is-sticky');
  });
  
  $('.hero-toggle-circle').on('click', function(){
      $('.hero-toggle-circle').toggleClass('right');
      
      if($('.hero svg >path').attr('fill') == '#000') {
        $('.hero svg > path').attr('fill','#535da1');
      } else {
        $('.hero svg > path').attr('fill','#000');
      }
  });

  
});
    
    
