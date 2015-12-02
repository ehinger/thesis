$(window).load(function(){
	$(".navbutton").on('click', function() {
		$("nav").toggleClass( "offset" );
		$(".hackSelectionFrame1").toggleClass( "offset2" );
	});

	// Bind the swipeleftHandler callback function to the swipe event on div.box
	// $( ".hackSelectionFrame1" ).on( "swipeleft", function() {

	// });
});

$('a').on('click', function(){
	a = $(this).attr("class");
	setTimeout(function () {
		location.href = a;
	}, 600);
});


//calls json file then creates two empty variables for the html that creates each recipe selection and the recipe screen.
//also creates 3 arrays to store secific json data in and converts the stored cookie into a new array.
$.getJSON('https://api.myjson.com/bins/4tu43', function (data) {
	var hackTabHtml = "";
	var hackInstructionsHtml = "";
	var htitle = [];
	var hinstructions = [];
	var selected = [];
	// var abilityLevel = $.cookie("ing").split(',');

	hackInstructionsHtml += "<div class='instructions'></div>";
	hackInstructionsHtml += "<div class='insframe'></div>";
	hackInstructionsHtml += "<p></p>";
	hackInstructionsHtml += "<div class='close'></div>";

//takes the json data and places each object within that matches the cookie data into the 'selected' array.
	$.each(data,function (index, recipe) {
			selected.push(recipe);
	});

//takes the 'selected' array and makes a new recipe selection for each item and also populates each one with the correct information. 
	$.each(selected, function(index, sel) {
		htitle.push(sel.title);
		hinstructions.push(sel.instructions);

		hackTabHtml += "<div class=" + index + ">";
		hackTabHtml += "<h1>" + sel.title + "</h1>";
		hackTabHtml += "<p>" + sel.caption + "</p>";
		hackTabHtml += "<img src=" + sel.imgurl + ">";
		hackTabHtml += "<div class='hackSelectionButton'>";
		hackTabHtml += "<h1>Enter</h1>";
		hackTabHtml += "</div>";
		hackTabHtml += "</div>";

		$('.hackSelectionFrame1').html(hackTabHtml);

		$(".hackSelectionFrame1 div").click(function() {
			var indexClass = $(this).attr("class");	$(".hackSelectionButton").on('click', function() {
			$("#instructions").css("top", 0);
			$(".insframe").css("top", "35%");
			$("#instructions").find("p").text(rinstructions[indexClass]);
		});

		$('#instructions').html(hackInstructionsHtml);

		$(".close").on('click', function() {
			$(".instructions").css("top", "100%");
			$(".insframe").css("top", "100%");
		});

	});
});
});