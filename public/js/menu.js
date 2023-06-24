$('.koch h2').click(function(){
    $('#form_koch').slideToggle(500);
    $('.koch .fa-play').toggleClass('open');
});
$('.nees h2').click(function(){
    $('#form_nees').slideToggle(500);
    $('.nees .fa-play').toggleClass('open');
});
$('.johnson h2').click(function(){
    $('#form_johnson').slideToggle(500);
    $('.johnson .fa-play').toggleClass('open');
});
if($('#johnson_couleursaleatoires').is(':checked')){
    $('input[type=color]').parent().css('display', 'none');
    console.log("Dans la fonction");
}
$('#johnson_couleursaleatoires').change(function(){
    if($('#johnson_couleursaleatoires').is(':checked')){
        $('input[type=color]').parent().css('display', 'none');
    }
    else
    {
        $('input[type=color]').parent().css('display', 'block');
    }
});