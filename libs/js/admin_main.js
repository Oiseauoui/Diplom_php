$(document).ready(function(){
     $('.kateg').bind('click',function(){
    $('.ktg').toggleClass('showktg');
    $('.ktg').append('<span class="closebtn">&times;</span>');
      $('.closebtn').bind('click',function(){
    $('.ktg').removeClass('showktg'); 
    
    $('.closebtn').detach();
    
});
});

    function mobMeni(){
            console.log('sklanja sve');
            $('.ktg').removeClass('showktg'); 
            $('.closebtn').detach();
        }
    
   
   $(window).resize(function(){
    mobMeni();
});
    mobMeni();
});
