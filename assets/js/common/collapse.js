/**
* collapse
*
*/
$('.sub-item p').slideUp('fast');

$('.clickable').click(function(){
    $(this).next('p').slideToggle('fast');
});
