$(window).load(function(){
	$(".navbutton").on('click', function() {
		$("nav").toggleClass( "offset" );
		$(".menuBar").toggleClass( "offset" );
		$(".hackSelectionFrame").toggleClass( "offset2" );
		$("#instructions").toggleClass( "offset2" );
		$(".insframe").toggleClass( "offset2" );
		$(".navbutton").toggleClass( "offset3" );
		$("body").toggleClass( "offset4" );
		$(".newHackFrame").toggleClass( "offset2" );
	});

	$(".hackSelectionButton").on('click', function() {
		$("#instructions").css("top", "5%");
		$(".insframe").css("top", "45%");
		$(".close").css("top", "10%");
		$("body").addClass( "offset4" );
		$(".newHackFrame").addClass( "offset2" );
	});

	$(".close").on('click', function() {
		$("#instructions").css("top", "100%");
		$(".insframe").css("top", "100%");
		$(".close").css("top", "100%");
		$("body").removeClass( "offset4" );
		$(".newHackFrame").removeClass( "offset2" );
	});

	$(".newHackFrame").on('click', function() {
		console.log("opening");
		$(".newHackFrame").addClass( "offset5" );
		$(".newHackFrame *").addClass( "offset6" );
		$("body").addClass( "offset4" );
	});

	$(".newHackClose").on('click', function(event) {
    	event.stopPropagation();
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").removeClass( "offset4" );
	});

	// Bind the swipeleftHandler callback function to the swipe event on div.box
	// $( ".hackSelectionFrame1" ).on( "swipeleft", function() {

	// });
});

$.ajax({
        async: true
 });

function closeHackFrame() {
	$(".newHackFrame").removeClass( "offset5" );
	$(".newHackFrame *").removeClass( "offset6" );
	$("body").removeClass( "offset4" );
	console.log("submit")
}

var selection = "";

function ingredientSelection() {
	selection += "<input type='number' name='ingredientsQuantity' min='1'>";
	selection += "<input name='hackIngredients' type='text'>";
	$('.ingredient').append(selection);
}

var steps = "";

var i = 1;

function hackSteps() {
	steps += "<h1>step " + i++ + "</h1>";
	steps += "<select name='stepIngredients'></select>";
	steps += "<input type='file' name='pic' accept='image/*'>";
	steps += "<textarea name='hackDesc' rows='10' cols='30'></textarea>";
	$('.steps').html(steps);
}

// $('a').on('click', function(){
// 	a = $(this).attr("class");
// 	setTimeout(function () {
// 		location.href = a;
// 	}, 600);
// });


// //calls json file then creates two empty variables for the html that creates each recipe selection and the recipe screen.
// //also creates 3 arrays to store secific json data in and converts the stored cookie into a new array.
// $.getJSON('https://s3-ap-southeast-2.amazonaws.com/elasticbeanstalk-ap-southeast-2-002364806998/json/hacks.json', function (data) {
// 	var hackTabHtml = "";
// 	var hackInstructionsHtml = "";
// 	var htitle = [];
// 	var hinstructions = [];
// 	var selected = [];
// 	// var abilityLevel = $.cookie("ing").split(',');

// 	hackInstructionsHtml += "<div class='instructions'></div>";
// 	hackInstructionsHtml += "<div class='insframe'></div>";
// 	hackInstructionsHtml += "<p></p>";
// 	hackInstructionsHtml += "<div class='close'></div>";

// //takes the json data and places each object within that matches the cookie data into the 'selected' array.
// 	$.each(data,function (index, recipe) {
// 			selected.push(recipe);
// 	});

// //takes the 'selected' array and makes a new recipe selection for each item and also populates each one with the correct information. 
// 	$.each(selected, function(index, sel) {
// 		htitle.push(sel.title);
// 		hinstructions.push(sel.instructions);

// 		hackTabHtml += "<div class=" + index + ">";
// 		hackTabHtml += "<h1>" + sel.title + "</h1>";
// 		hackTabHtml += "<p>" + sel.caption + "</p>";
// 		hackTabHtml += "<img src=" + sel.imgurl + ">";
// 		hackTabHtml += "<div class='hackSelectionButton'>";
// 		hackTabHtml += "<h1>Enter</h1>";
// 		hackTabHtml += "</div>";
// 		hackTabHtml += "</div>";

// 		$('.hackSelectionFrame1').html(hackTabHtml);

// 		$(".hackSelectionFrame1 div").click(function() {
// 			var indexClass = $(this).attr("class");	$(".hackSelectionButton").on('click', function() {
// 			$("#instructions").css("top", 0);
// 			$(".insframe").css("top", "35%");
// 			$("#instructions").find("p").text(rinstructions[indexClass]);
// 		});

// 		$('#instructions').html(hackInstructionsHtml);

// 		$(".close").on('click', function() {
// 			$(".instructions").css("top", "100%");
// 			$(".insframe").css("top", "100%");
// 		});

// 	});
// });
// });