$(window).load(function(){
	$(".navbutton").on('click', function() {
		$("nav").toggleClass( "offset" );
		$(".hackSelectionFrame1").toggleClass( "offset2" );
	});

	$(".hackSelectionButton").on('click', function() {
		$(".instructions").css("top", 0);
		$(".insframe").css("top", "35%");
	});

	$(".close").on('click', function() {
		$(".instructions").css("top", "100%");
		$(".insframe").css("top", "100%");
	});

	// Bind the swipeleftHandler callback function to the swipe event on div.box
	$( ".hackSelectionFrame1" ).on( "swipeleft", function() {
		$(".instructions").css("top", 0);
		$(".insframe").css("top", "35%");
	});
});

$('a').on('click', function(){
	a = $(this).attr("class");
	setTimeout(function () {
		location.href = a;
	}, 600);
});