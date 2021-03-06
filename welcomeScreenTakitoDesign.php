<!DOCTYPE html >
<html lang="en" onload="if (location.href.indexOf('reload')==-1) location.replace(location.href+'?reload');">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Welcome Screen</title>

	<!--Google font-->
	<link href='https://fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Trade+Winds' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="Style/style_welcome_difficulty.css">
    <link rel="stylesheet" type="text/css" href="Style/style_settings.css">

	<!--IMPORT GLOBAL VARIABLE FOR THE SCRIPT NEEDED BELOW-->
    <script src="Scripts/global.js"></script>
	<!--IMPORT FUNCTIONS FOR BACKGROUND MUSIC/SFX-->
	<script src="Scripts/sounds.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- [endif]-->
</head>

<body>

	<!-- Title container below. -->
	<div class="container">

	<div class="row">
		<div class="col-xs-12 text-center">
			<!-- The 'Logicolor' logo changes to 'Dodecolor' when clicked. -->
			<img id="myLogo" onclick="easterEgg()" src="images/logo.gif" alt="logicolor" width="300px" height="80px">
		</div>
	</div>

	<!--
	Options Container below. Similar to the difficultyCopyTakitoTest,
	I copied the format which I think works well.
	-->
	<div class="jumbotron">
		<div class="row heading_welcome">
			<div class="col-xs-12 text-centre">
				<h3 class="text-success text-center">
					Pick your Dogeventure!
				</h3>
			</div>
		</div>
		<div id="doge">
			<button type="button" class="dodge btn btn-lg btn-block">
				<img class="img-circle" src="images/dodge.gif" width="30px" height="30px" alt="">Marathon Mode</button>
			<button type="button" class="dodge btn btn-lg btn-block">Speed Mode</button>
			<button type="button" class="dodge btn btn-lg btn-block">Leaderboard</button>
			<button type="button" class="dodge btn btn-lg btn-block">Tutorial</button>
			<button type="button" class="dodge btn btn-lg btn-block" id="myBtn">Settings</button>
			<button type="button" class="dodge btn btn-lg btn-block">Rewards</button>
		</div>
		
			<!-- 
			Modals Below! 
			Note that the modals are stored in their individual files (in pieces) and the individual pieces
			are called with php.
			-->

					
	<?php

	include 'tutorialModal.php';

	include 'settingsModal.php';

	include 'achievementsModal.php';

	include 'rewardsAutomatedModals.php';

	?>
	<span id="additionalModals"></span>

		</div>
	</div>

	<!-- Include all compiled plugins (below), or include individual files as needed -->

	<script>
		var index = 1;
		//DOM manipulation of this particular site happens below
		$(document).ready(function(){
			document.getElementById('musicVal').innerHTML = musicVol*10;
			document.getElementById('sfxVal').innerHTML = sfxVol*10;
			document.getElementById('musicslider').value = musicVol*10;
			document.getElementById('sfxslider').value = sfxVol*10;
			playMusic(this,'Sound/menumusic.mp3')
			//The first two functions below this message allow me to manipulate the dodge pic
			//so the selector moves as the user clicks. We can change that eventually if we like to.
			$(".dodge").find("img").css({"float":"left"});
			
			$(".dodge").click(function(){
				if(index == whichChild(this)){
					switch(index){
						case 1: window.location.href = "marathon.html";
								break;
						case 2: window.location.href = "speedmode.html";
								break;
						case 3: window.location.href = "marathon-leaderboard.php";
								break;
						case 4: $("#tutorialModal").modal();
								break;
						case 5: $("#settingsModal").modal();
								break;
								//data-toggle="modal" data-target="#settingsModal"
						case 6: $("#rewardsModal").modal();
								break;
						default: break;
					}
				}
				index = whichChild(this);
				$(".dodge").find("img").remove();
				$(this).prepend("<img class=\"img-circle\" src=\"images/dodge.gif\" width=\"30px\"; height=\"30px\" alt=\"\">");
				$(".dodge").find("img").css({"float":"left"});
			});

			//The following function manipulates the DOM so the whole container class centers in any
			//cellphone and the background color stays #515151.
			$(".container").css({

				//"padding-top":"30%",
				//"padding-bottom":"30%",
				"background-color":"#51514F"

			});

			//The following piece of code calls the most recent rewards earned by the player!
			$.get(
				"rewards.php",
				{},
				function (data){
					$("#rewardQuery").html(data);
				}
			)
			event.preventDefault();

			//The following piece of code calls the modal that only activates on the day the award was earned.
			$("#rewardModal1").modal();
			$("#rewardModal2").modal();
			$("#rewardModal3").modal();
			
		});
		
		function easterEgg() {
			var image = document.getElementById('myLogo');
			if (image.src.match("alt")) {
				image.src = "images/logo.gif";
			} else {
				image.src = "images/logoalt.gif";
				playSound(this,'Sound/woof.mp3');
			}
		}
		
		function whichChild(elem){
			var i = 1;
			while((elem=elem.previousElementSibling)!=null)
				++i;
			return i;
		}
		
		document.getElementById('musicVal').innerHTML = musicVol*10;
		document.getElementById('sfxVal').innerHTML = sfxVol*10;
		
	</script>
</body>
</html>