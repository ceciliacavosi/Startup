$( ".cross" ).hide();
$( ".menu" ).hide();
$( ".hamburger" ).click(function() {
$( ".menu" ).slideToggle( "slow", function() {
$( ".hamburger" ).hide();
$( ".cross" ).show();
});
});

$( ".cross" ).click(function() {
$( ".menu" ).slideToggle( "slow", function() {
$( ".cross" ).hide();
$( ".hamburger" ).show();
$(".subMenu").hide();
});
});
$(".udienze").click(
    function(){
    $(".subMenu").slideToggle("slow");	//imposta fast o slow
});


$(".subMenu").hide();
$(".udienze").click(function(){
    $(".subMenu").show();
});


