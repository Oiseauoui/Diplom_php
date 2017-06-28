$(document).ready(function(){
  
 $( ".items_list li" ).mouseenter(
  function() {
    $(this).find('.hvrdiv').css('opacity','0.9');
    $(this).find('h3 a').css('color','black');
    $(this).find('.price').css('color','#43C793');
  }).mouseleave(function(){
    $(this).find('.hvrdiv').css('opacity','0');
    $(this).find('h3 a').css('color','dimgray');
    $(this).find('.price').css('color','#78BCA1');
  });
  
  $('.login-input').on('focus',function(){
    $(this).addClass('animated pulse');
  }).on('blur',function(){$(this).removeClass('animated pulse');});
  
    
  $(window).scroll(function(){
  if ($(window).scrollTop() > 60 ) {
    $('nav.wrap').addClass('animated slideInDown fixed');
    $('body').css('paddingTop',60);
    $('#arrow-top').fadeIn('slow');
  }
   else {
    $('nav.wrap').removeClass('animated slideInDown fixed');
    $('body').css('paddingTop',0);
    $('#arrow-top').fadeOut('slow');
   }
});
    $( "#arrow-top" ).click(function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });
        
    $('.kateg').bind('click',function(){
        console.log('klik');
    $('.ktg').toggleClass('showktg');
    $('.ktg').append('<span class="closebtn">&times;</span>');
      $('.closebtn').bind('click',function(){
    $('.ktg').removeClass('showktg'); 
    
    $('.closebtn').detach();
    
});
});

    function mobMeni(){
        $('.ktg').removeClass('showktg'); 
        $('.closebtn').detach();
    }
    
   
   $(window).resize(function(){
    mobMeni();
});
    //mobMeni();
    
$('.plus').bind('click', function()
{
    var value = parseInt(document.getElementById('kolicina').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('kolicina').value = value;
});
$('.minus').bind('click',function()
{
    var value = parseInt(document.getElementById('kolicina').value, 10);
    value = isNaN(value) ? 0 : value;
      if (value > 1) {
        value--;
    }
    document.getElementById('kolicina').value = value;
});
$('#kolicina').keypress(function (e) {
            
            if (e.which == 13)
            {
                return true;
            }
            
            // moze samo broj
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
            // ne moze minus
            if (e.which == 45)
                return false;
        });
        
 $('.klikKupi').bind('click',function(event){
     var kolicina=document.getElementById('kolicina').value;
     if (kolicina=='' || kolicina == 0){
         console.log('prazno je');
         $('.poruka').text('Unesite kolicinu !');
         event.preventDefault();
     }
 });
 
 $('span.klik').click(function() {
     if($(this).hasClass('glyphicon-triangle-bottom')){
     $(this).parent().children('.sub_categories_list').slideUp();
     $(this).removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
     } else if($(this).hasClass('glyphicon-triangle-right')){
        $(this).parent().children('.sub_categories_list').slideDown(); 
        $(this).removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
     }    
});


 
   
});


function initialize(){
var myCenter=new google.maps.LatLng(43.319607, 21.894556);
var podaci=document.getElementsByClassName('podaci');
var contentString = podaci[0];
var mapProp = {
  center:myCenter,
  zoom:15,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("mapa"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

var infowindow = new google.maps.InfoWindow({
  content: contentString
  });

infowindow.open(map,marker);
}

