var hackID;

var ajaxurl;

var fol = "";
var h;

$(window).load(function(){
	$(".navbutton").on('click', function() {
		$("nav").toggleClass( "offset" );
		$(".startRegistration").toggleClass( "offset" );
		$(".menuBarYourHacks").toggleClass( "offset" );
		$(".menuBarProfile").toggleClass( "offset" );
		$(".menuBarSettings").toggleClass( "offset" );
		$(".hackSelectionFrame").toggleClass( "offset2" );
		$("#instructions").toggleClass( "offset2" );
		$(".insframe").toggleClass( "offset2" );
		$(".navbutton").toggleClass( "offset3" );
		$("body").toggleClass( "offset4" );
		$(".newHackFrame").toggleClass( "offset7" );
	});

	$(".menuBarYourHacks").on('click', function() {
		$(".logInPage").hide();
		$(".loggedInPage").hide();
		$(".registerPage").hide();
		$(".yourSettingsPage").hide();
		$(".yourHacksPage").show();
	});

	$(".menuBarProfile").on('click', function() {
		$(".registerPage").hide();
		$(".yourHacksPage").hide();
		$(".yourSettingsPage").hide();
		if (Cookies.get('userId')) {
			$(".loggedInPage").show();
		} else {
			$(".logInPage").show();
		}
	});

	$(".menuBarSettings").on('click', function() {
		$(".logInPage").hide();
		$(".loggedInPage").hide();
		$(".registerPage").hide();
		$(".yourHacksPage").hide();
		$(".yourSettingsPage").show();
	});

	$(".startRegistration").on('click', function() {
		$(".logInPage").hide();
		$(".registerPage").show();
	});

	$(".hackSelectionButton").on('click', function() {
		hackI = $(this).parent().attr('id');
		function ihg (hackID) {
			$(".hackSelectionFrame").css("overflowY", "scroll");
			// $(".hackSelectionFrame").css("height", "100%");
			$("#" + hackID + " .infoWrapper").css("width", "100%");
			$("#" + hackID + " .insframe").css("opacity", "1");
			$("#" + hackID + " .insframe").css("height", "auto");
			$("#" + hackID + " .hackSelectionButton").css("opacity", "0");
			$("#" + hackID + " .hackSelectionButton").css("left", "100%");
			$("#" + hackID + " .close").css("opacity", "1");
			$("#" + hackID + " .close").css("right", "0");
			$("body").removeClass( "offset4" );
			$(".newHackFrame").removeClass( "offset7" );
			$("body").scrollTop($("#" + hackID).offset().top - parseInt($(".navbutton").css("height")));
			console.log();
		}
		ihg(hackI);
		// ajaxurl = 'index.php';
		// window.location.href = "#index.php?hackI=" + hackID;
        // $.post(ajaxurl, hackID, function (response) {
        //     // Response div goes here.
        //     console.log(hackID);
        // });
	});

	$(".close").on('click', function() {
		$(".hackSelectionFrame").scrollTop(0);
		$(".hackSelectionFrame").css("overflow", "hidden");
		$(".hackSelectionFrame").css("height", "85%");
		$(".infoWrapper").css("width", "70%");
		$(".insframe").css("opacity", "0");
		$(".hackSelectionButton").css("opacity", "1");
		$(".hackSelectionButton").css("left", "10%");
		$(".close").css("opacity", "0");
		$(".close").css("right", "100%");
		$("body").addClass( "offset4" );
		$(".newHackFrame").addClass( "offset7" );
	});

	$(".newHackFrame").on('click', function() {
		console.log("opening");
		$(".newHackFrame").css("overflowY", "scroll");
		$(".newHackFrame").addClass( "offset5" );
		$(".newHackFrame *").addClass( "offset6" );
		$("body").removeClass( "offset4" );
	});

	$(".newHackClose").on('click', function(event) {
    	event.stopPropagation();
		$(".newHackFrame").css("overflow", "hidden");
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").addClass( "offset4" );
	});

	$(".follow").on('click', function() {
		h = $(this).attr('id');
		// Cookies.set('follow', $(this).attr('id'));
		fol += "<input type='hidden' name='followInput' value='" + h + "'>";
		fol += "<input type='submit' name='followButton'>"
		$('#followForm').html(fol);
		console.log("starting");

		// var event = jQuery.Event( "submit" );
		$( "#followForm" ).trigger("submit");
		if ( event.isDefaultPrevented() ) {
  			console.log("please work");
		}
	});

	if (Cookies.get('userId')) {
		$(".logInPage").hide();
		$(".loggedInPage").show();
		$(".newHackFrame").show();
	} else {
		$(".logInPage").show();
		$(".loggedInPage").hide();
		$(".newHackFrame").hide();
	}

	// $('.button').click(function(){
 //        var clickBtnValue = $(this).val();
 //        var ajaxurl = 'ajax.php',
 //        data =  {'action': clickBtnValue};
 //        $.post(ajaxurl, data, function (response) {
 //            // Response div goes here.
 //            alert("action performed successfully");
 //        });
 //    });

	// Bind the swipeleftHandler callback function to the swipe event on div.box
	// $( ".hackSelectionFrame1" ).on( "swipeleft", function() {

	// });
});

function closeHackFrame() {
	$(".newHackFrame").removeClass( "offset5" );
	$(".newHackFrame *").removeClass( "offset6" );
	$("body").removeClass( "offset4" );
	location.reload(true);
	console.log("submit");
}

var selection = "";

function ingredientSelection() {
	selection = "";
	selection += "<input type='number' name='ingredientsQuantity[]' min='1'>";
	selection += "<input name='hackIngredients[]' type='text'>";
	$('.ingredient').append(selection);
}

var steps = "";

var i = 1;

function hackSteps() {
	steps += "<h1>step " + i++ + "</h1>";
	steps += "<input name='userfile[]' type='file'>";
	steps += "<label>Step description:</label>";
	steps += "<textarea name='hackIns[]' rows='10' cols='30'></textarea>";
	$('.steps').html(steps);
}

function textSize(v) {
	$("html").css( "font-size", v + "px");
	console.log(v);
}

// var questions = "";

function abilityProfileStageTwo() {
    $(".abilityProfileStageTwoButton").hide();
	$('.rangeOne').show();
    $('.nextThreeQuestions').show();
    $('.abilityRegister').show();

    // questions += "";
    // questions += "<p>On a scale of not at all to not a problem:</p>"; 
    // questions += "<label></label>";
    // questions += '<input class="q1" type="range" name="q1" min="0" max="10">';
    // questions += '<label></label>';
    // questions += '<input class="q2" type="range" name="q2" min="0" max="10">';
    // questions += '<label></label>';
    // questions += '<input class="q3" type="range" name="q3" min="0" max="10">';
    // questions += '<input class="nextThreeQuestions" type="button" onclick="abilityProfileNextThreeQuestions()" value="Next">';
    // questions += '<input type="submit" value="abilityRegister" name="abilityRegister">';
    // $('#abilityRegister').append(questions);
}

// var n = 4;

// var questionsNew = "";

function abilityProfileNextThreeQuestions() {
    if ($('.rangeTwo').css('display') == 'none') {
    	$('.rangeTwo').show();
    } else {
    	$('.rangeThree').show();
    }
 // questionsNew = "";
 // questionsNew += '<label></label>';
 // questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
 // questionsNew += '<label></label>';
 // questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
 // questionsNew += '<label></label>';
 // questionsNew += '<input class="q' + n + '" type="range" name="q' + n++ + '" min="0" max="10">';
 // $('.nextThreeQuestions').before(questionsNew);
 // console.log(n++, n++, n++);
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