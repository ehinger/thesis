var hackID;

var ajaxurl;

var fol = "";
var h;

$(window).load(function(){
	$(".navbutton").on('click', function() {
		$("nav").toggleClass( "offset" );
		console.log($(".menuBarProfile").css("top"));
		$(".startRegistration").toggleClass( "offset" );
		if ($(".menuBarProfile").css("top") == "0px") {
			$(".menuBarYourHacks").css("top", "-100%");
			$(".menuBarProfile").css("top", "-100%");
			$(".menuBarSettings").css("top", "-100%");
		} else {
			$(".menuBarYourHacks").css("top", "0");
			$(".menuBarProfile").css("top", "0");
			$(".menuBarSettings").css("top", "0");
		}
		$(".hackSelectionFrame").toggleClass( "offset2" );
		$("#instructions").toggleClass( "offset2" );
		$(".insframe").toggleClass( "offset2" );
		$(".navbutton").toggleClass( "offset3" );
		$("body").toggleClass( "offset4" );
		$(".newHackFrame").toggleClass( "offset7" );
		$(".newHackFrame").css("overflow", "hidden");
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").addClass( "offset4" );
		if ($(".navText").text() == "Browse") {
			$(".navText").text("Menu");
		} else {
			$(".navText").text("Browse");
		}
	});

	$(".menuBarYourHacks").on('click', function() {
			$(".menuBarProfile").css("borderWidth", "2px");
			$(".menuBarSettings").css("borderWidth", "2px");
			$(".menuBarYourHacks").css("borderWidth", "8px");
		if (Cookies.get('userId')) {
			$(".logInPage").hide();
			$(".loggedInPage").hide();
			$(".registerPage").hide();
			$(".yourSettingsPage").hide();
			$(".yourHacksPage").show();
			$(".yourHacksButtons").show();
			$(".yourHacksMade").hide();
			$(".followedHacks").hide();
			$(".yourHacksButtons").css("left", "0");		
			$(".newHackFrame").css("overflow", "hidden");
			$(".newHackFrame").removeClass( "offset5" );
			$(".newHackFrame *").removeClass( "offset6" );
			$("body").addClass( "offset4" );
		} else {
			$(".hacksLogIn").show();
			$(".logInPage").hide();
			$(".loggedInPage").hide();
			$(".registerPage").hide();
			$(".yourSettingsPage").hide();
			$(".yourHacksMade").hide();
			$(".followedHacks").hide();
		}

	});

	$(".yourHacksYourHacks").on('click', function() {
		$(".yourHacksButtons").hide();
		$(".yourHacksButtons").css("left", "100%");
		$(".yourHacksMade").show();
	});	

	$(".yourHacksFollowedHacks").on('click', function() {
		$(".yourHacksButtons").hide();
		$(".yourHacksButtons").css("left", "100%");
		$(".followedHacks").show();
		$(".yourHacksPage").css("overflowY", "hidden");
	});

	$(".yourHacksCreateHacks").on('click', function() {
		console.log("opening");
		$(".newHackFrame").css("overflowY", "scroll");
		$(".newHackFrame").addClass( "offset5" );
		$(".newHackFrame *").addClass( "offset6" );
		$("body").removeClass( "offset4" );
	});

	$(".menuBarProfile").on('click', function() {
		$(".hacksLogIn").hide();
		$(".registerPage").hide();
		$(".yourHacksPage").hide();
		$(".yourSettingsPage").hide();
		if (Cookies.get('userId')) {
			$(".loggedInPage").show();
		} else {
			$(".logInPage").show();
		}
		$(".yourHacksMade").hide();
		$(".followedHacks").hide();
		$(".yourHacksButtons").css("left", "0");		
		$(".newHackFrame").css("overflow", "hidden");
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").addClass( "offset4" );
		$(".menuBarProfile").css("borderWidth", "8px");
		$(".menuBarSettings").css("borderWidth", "2px");
		$(".menuBarYourHacks").css("borderWidth", "2px");
	});

	$(".menuBarSettings").on('click', function() {
		$(".hacksLogIn").hide();
		$(".logInPage").hide();
		$(".loggedInPage").hide();
		$(".registerPage").hide();
		$(".yourHacksPage").hide();
		$(".yourSettingsPage").show();
		$(".yourHacksMade").hide();
		$(".followedHacks").hide();
		$(".yourHacksButtons").css("left", "0");		
		$(".newHackFrame").css("overflow", "hidden");
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").addClass( "offset4" );
		$(".menuBarProfile").css("borderWidth", "2px");
		$(".menuBarSettings").css("borderWidth", "8px");
		$(".menuBarYourHacks").css("borderWidth", "2px");
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
			$("#" + hackID + " .insframe").css("opacity", "1");
			$("#" + hackID + " .insframe").css("height", "auto");
			$("#" + hackID + " .infoWrapper").css("height", "90%");
			$("#" + hackID + " .hackButtonText").text("Scroll down");
			$("#" + hackID + " .hackButtonText").css("bottom", "-70%");
			$("#" + hackID + " .hackSelectionButton").css("bottom", "10%");
			$("#" + hackID + " .hackArrow").css("margin", "60% auto");
			$("#" + hackID + " .close").css("opacity", "1");
			$("#" + hackID + " .close").css("right", "0");
			$("#" + hackID).css("height", "100%");
			$("body").removeClass( "offset4" );
			$(".newHackFrame").removeClass( "offset7" );
			$("body").scrollTop($("#" + hackID).offset().top - parseInt($(".navbutton").css("height")));
			$(".hackSelectionButton").css("z-index", "0")
			console.log(parseInt($(".navbutton").css("height")));
			Cookies.set('followId', hackID);
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
		$(".insframe").css("opacity", "0");
		$(".hackButtonText").text("Enter");
		$(".hackButtonText").css("bottom", "-75%");
		$(".hackSelectionButton").css("bottom", "0");
		$(".hackArrow").css("margin", "55% auto");
		$(".close").css("opacity", "0");
		$(".close").css("right", "100%");
		$("body").addClass( "offset4" );
		$(".newHackFrame").addClass( "offset7" );
		$(".hackSelectionButton").css("z-index", "2")
	});

	$(".hackSelectionButtonYourHacks").on('click', function() {
		hackI = $(this).parent().attr('id');
		function ihg (hackID) {
			$(".hackSelectionFrameYourHacks").css("overflowY", "scroll");
			// $(".hackSelectionFrame").css("height", "100%");
			$("#" + hackID + " .insframeYourHacks").css("opacity", "1");
			$("#" + hackID + " .insframeYourHacks").css("height", "auto");
			$("#" + hackID + " .hackButtonText").text("Scroll down");
			$("#" + hackID + " .closeYourHacks").css("opacity", "1");
			$("#" + hackID + " .closeYourHacks").css("right", "0");
			$("#" + hackID + " .closeYourHacks").css("right", "0");
			// $(".yourHacksMade").css("top", "10%");
			$(".yourHacksMade").css("overflow", "hidden");
			$(".yourHacksMade").scrollTop($("#" + hackID + "YourHacks .hackHeroImageYourHacks").offset().top);
			console.log("#" + hackID + "YourHacks .hackHeroImageYourHacks");
			Cookies.set('followId', hackID);

		}
		ihg(hackI);
		// ajaxurl = 'index.php';
		// window.location.href = "#index.php?hackI=" + hackID;
        // $.post(ajaxurl, hackID, function (response) {
        //     // Response div goes here.
        //     console.log(hackID);
        // });
    });

	$(".closeYourHacks").on('click', function() {
		$(".hackSelectionFrameYourHacks").scrollTop(0);
		$(".hackSelectionFrameYourHacks").css("overflow", "hidden");
		$(".hackSelectionFrameYourHacks").css("height", "85%");
		$(".insframeYourHacks").css("opacity", "0");
		$(".hackButtonText").text("Enter");
		$(".closeYourHacks").css("opacity", "0");
		$(".closeYourHacks").css("right", "100%");
		$(".yourHacksMade").css("overflow", "auto");
		$(".yourHacksMade").css("top", "0");
	});

	$(".hackSelectionButtonFollowedHacks").on('click', function() {
		hackI = $(this).parent().attr('id');
		function ihg (hackID) {
			$(".hackSelectionFrameFollowedHacks").css("overflowY", "scroll");
			// $(".hackSelectionFrame").css("height", "100%");
			$("#" + hackID + " .insframeFollowedHacks").css("opacity", "1");
			$("#" + hackID + " .insframeFollowedHacks").css("height", "auto");
			$("#" + hackID + " .hackButtonText").text("Scroll down");
			$("#" + hackID + " .closeFollowedHacks").css("opacity", "1");
			$("#" + hackID + " .closeFollowedHacks").css("right", "0");
			$("body").removeClass( "offset4" );
			$("body").scrollTop($("#" + hackID).offset().top - parseInt($(".navbutton").css("height")));
			console.log($("#" + hackID + " .closeFollowedHacks").css("right", "0"));
			Cookies.set('followId', hackID);
		}
		ihg(hackI);
		// ajaxurl = 'index.php';
		// window.location.href = "#index.php?hackI=" + hackID;
        // $.post(ajaxurl, hackID, function (response) {
        //     // Response div goes here.
        //     console.log(hackID);
        // });
    });

	$(".closeFollowedHacks").on('click', function() {
		$(".hackSelectionFrameFollowedHacks").scrollTop(0);
		$(".hackSelectionFrameFollowedHacks").css("overflow", "hidden");
		$(".hackSelectionFrameFollowedHacks").css("height", "85%");
		$(".insframeFollowedHacks").css("opacity", "0");
		$(".hackButtonText").text("Enter");
		$(".closeFollowedHacks").css("opacity", "0");
		$(".closeFollowedHacks").css("right", "100%");
		$("body").addClass( "offset4" );
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

	// $(".follow").on('click', function() {
	// 	h = $(this).attr('id');
	// 	// Cookies.set('follow', $(this).attr('id'));
	// 	fol += "<input type='hidden' name='followInput' value='" + h + "'>";
	// 	fol += "<input type='submit' name='followButton'>"
	// 	$('#followForm').html(fol);
	// 	console.log("starting");

	// 	// var event = jQuery.Event( "submit" );
	// 	$( "#followForm" ).trigger("submit");
	// 	if ( event.isDefaultPrevented() ) {
	// 		console.log("please work");
	// 	}
	// });

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
	selection += "<p class='ingTitle'>Amount:</p>";
	selection += "<input type='number' name='ingredientsQuantity[]' min='1'>";
	selection += "<p class='ingTitle'>Resource:</p>";
	selection += "<input name='hackIngredients[]' type='text'>";
	selection += "<p class='ingTitle'>Alternative:</p>";
	selection += "<input name='hackIngredientsAlt[]' type='text'>";
	$('.ingredient').append(selection);
}

var tip = "";

function tipAdd() {
	tip = "";
	tip += "<input name='hackTips[]' type='text'>";
	$('.tips').append(tip);
}


var i = 2;

function hackStepsMake() {
	var steps = "";
	steps += "<h1>step " + i++ + "</h1>";
	steps += "<input name='userfile[]' type='file'>";
	steps += "<label>Step description:</label>";
	steps += "<textarea name='hackIns[]' rows='10' cols='30'></textarea>";
	$('.stepsMake').append(steps);
}

var n = 2;

function hackStepsUse() {
	var steps = "";
	steps += "<h1>step " + n++ + "</h1>";
	steps += "<input name='userfile[]' type='file'>";
	steps += "<label>Step description:</label>";
	steps += "<textarea name='hackUse[]' rows='10' cols='30'></textarea>";
	$('.stepsUse').append(steps);
}

function textSize(v) {
	$("html").css( "font-size", v + "px");
	console.log(v);
}

// var questions = "";
var abilitySwitchContinuation = "";

function abilityProfileStageOne() {
	// if () {

	// } else {

	// }
}

function abilityProfileStageTwo() {
	if ($(".upperLimblowerLimb").val() == "Upper Limb") {
			Cookies.set('abilityUOrL', "upper");
			abilitySwitchContinuation = $(".upperLimblowerLimb").val();
			$(".lowerLimbButton").hide();
			$('.rangeOneUpper').show();
			$('.nextThreeQuestions').show();
			$('.abilityRegister').show();
			console.log($(".upperLimblowerLimb").val())
	} else if ($(".upperLimblowerLimb").val == "Lower Limb") {
			Cookies.set('abilityUOrL', "lower");
			abilitySwitchContinuation = $(".upperLimblowerLimb").val();
			$(".upperLimbButton").hide();
			$('.rangeOneLower').show();
			$('.nextThreeQuestions').show();
			$('.abilityRegister').show();
	} else {
		abilitySwitchContinuation = "";
		$(".upperLimbButton").show();
		$(".lowerLimbButton").show();
		$('.rangeOneUpper').hide();
		$('.rangeTwoUpper').hide();
		$('.rangeThreeUpper').hide();
		$('.rangeOneLower').hide();
		$('.rangeTwoLower').hide();
		$('.rangeThreeLower').hide();
		$('.nextThreeQuestions').hide();
		$('.abilityRegister').hide();
		console.log($(".upperLimblowerLimb").val())
	}

}
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

// var n = 4;

// var questionsNew = "";

function abilityProfileNextThreeQuestions() {
	if (abilitySwitchContinuation == 'Upper Limb') {
		if ($('.rangeTwoUpper').css('display') == 'none') {
			Cookies.set('abilityFocusPost', "lvl2Upper");
			$('.rangeTwoUpper').show();

		} else {
			$('.rangeThreeUpper').show();
			$('.nextThreeQuestions').hide();
			Cookies.set('abilityFocusPost', "lvl3Upper");
		}
	} else {
		if ($('.rangeTwoLower').css('display') == 'none') {
			$('.rangeTwoLower').show();
		} else {
			$('.rangeThreeLower').show();
			$('.nextThreeQuestions').hide();
		}		
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