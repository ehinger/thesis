var hackID;

var ajaxurl;

var fol = "";
var h;

$("html, body, #wrapper").css({
    height: $(window).height()
});

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
		if ($(".navText").text() == "Start browsing") {
			$(".navText").text("Menu");
		} else {
			$(".navText").text("Start browsing");
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
		$(".newHackFrame").css("z-index", "2");
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
			// $("body").removeClass( "offset4" );
			$(".newHackFrame").css("z-index", "0");
			$("#wrapper").css("overflow", "hidden");
			$("#wrapper").scrollTop($("#" + hackID ).position().top - parseInt($(".navbutton").css("height")));
			$(".hackSelectionButton").css("z-index", "0")
			console.log(parseInt($(".navbutton").css("height")));
			Cookies.set('followId', hackID);
		}
		ihg(hackI);

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
			$("#wrapper").css("overflow", "auto");
			$(".newHackFrame").css("z-index", "2");
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
			$("#" + hackID).css("height", "90%");
			$(".yourHacksMade").css("overflow", "hidden");
			$(".yourHacksMade").scrollTop($("#" + hackID ).position().top - parseInt($(".menuBarYourHacks").css("height")));
			Cookies.set('followId', hackID);

		}
		ihg(hackI);

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
			$("#" + hackID + " .insframeFollowedHacks").css("opacity", "1");
			$("#" + hackID + " .insframeFollowedHacks").css("height", "auto");
			$("#" + hackID + " .hackButtonText").text("Scroll down");
			$("#" + hackID + " .closeFollowedHacks").css("opacity", "1");
			$("#" + hackID + " .closeFollowedHacks").css("right", "0");
			$("#" + hackID).css("height", "90%");
			$(".yourHacksMade").css("overflow", "hidden");
			$(".followedHacks").scrollTop($("#" + hackID ).position().top - parseInt($(".menuBarYourHacks").css("height")));
			Cookies.set('followId', hackID);
		}
		ihg(hackI);

    });

	$(".closeFollowedHacks").on('click', function() {
		$(".hackSelectionFrameFollowedHacks").scrollTop(0);
		$(".hackSelectionFrameFollowedHacks").css("overflow", "hidden");
		$(".hackSelectionFrameFollowedHacks").css("height", "85%");
		$(".insframeFollowedHacks").css("opacity", "0");
		$(".hackButtonText").text("Enter");
		$(".closeFollowedHacks").css("opacity", "0");
		$(".closeFollowedHacks").css("right", "100%");
		$(".followedHacks").css("overflow", "auto");
		$(".followedHacks").css("top", "0");
	});

	$(".newHackFrame").on('click', function() {
		console.log("opening");
		$(".newHackFrame").css("overflowY", "scroll");
		$(".newHackFrame").addClass( "offset5" );
		$(".newHackFrame *").addClass( "offset6" );
		$("body").removeClass( "offset4" );
		$("createText").css("display", "hidden");
	});

	$(".newHackClose").on('click', function(event) {
		event.stopPropagation();
		$(".newHackFrame").css("overflow", "hidden");
		console.log("closing");
		$(".newHackFrame").removeClass( "offset5" );
		$(".newHackFrame *").removeClass( "offset6" );
		$("body").addClass( "offset4" );
		$("createText").css("opacity", "1");
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

}