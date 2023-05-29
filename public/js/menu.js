console.log($('.koch i'))
$('.koch h2').click(function(){
    $('#form_koch').slideToggle(500);
    $('.koch i').style.transform("rotate(90deg)")
});
$('.nees h2').click(function(){
    $('#form_nees').slideToggle(500);
    $('.nees i').style.transform("rotate(90deg)")
});