<?php
//	include 'Mobile_Detect.php';
//	$detect = new Mobile_Detect();
//	
//	if (!$detect->isMobile()) {
//	    // Any mobile device.
//	    header("Location: mobiletest/iphone.php?url=stanford.edu/~szheng0/cgi-bin/balancev3/mobile.php");
//	}
	
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->





<!DOCTYPE html>
<html>
	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	//include("head.php");
	?>
	
	<!--======================================= -->
	<!-- REMOVE THIS AFTER THE OPTIMIZELY!!!!! and put the include above back in  -->
	<head>
		<title>Balance</title>

		<!--Favicon and touch icons-->
		<!-- Deal with these later -->
		<link rel="shortcut icon" href="img/favicon.ico">
		<link rel="apple-touch-icon" href="img/appicon.png" /> 
		<link rel="apple-touch-startup-image" href="img/startup.png"> 

		<!-- Stuff for displaying on mobile-->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="width=device-width, user-scalable=no" />

		<!--Below line, from Rio's examples, ask him if we don't know what it is-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		
		<!-- Our style sheet-->
		<link href="css/style.css" rel="stylesheet">
		<!-- Bootstrap stylesheets-->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!--<link href="css/bootstrap-responsive.css" rel="stylesheet">-->
		<!-- NOTE: there are more specific bootstrap css files we can get and js files too - ask Xan-->		
	</head>
	<!--======================================= -->
	<!--======================================= -->


	<body>
	
		<!-- Note,back button to the header... make invisible on homepage??? -->
		<!-- Simon: removed partial for banned and copied code below for tutorial page -->
		<div class=" navbar-static-top navbar-inverse navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		    	<div class="container">
		          <button type="button" class="btnMenu collapsed" data-toggle="collapse" data-target=".nav-collapse">
		            <img class="menuImg" src="img/icons/menu.png">
		          </button>
		          
		          <!-- back button--> 
		          	<a href="javascript:history.go(-2)"><img src="img/icons/back.png" class="backBtn"></a>
		          	  <span class="navbarText brand">Tutorial</span>
		          <div class="nav-collapse collapse" style="height: 0px; ">
		            <ul class="nav headerList">
		              <li class=<?php echo $home;?>>
		                <a href="./index.php"><img src="img/icons/homeDark.png" class ="navIcons">home</a> <!-- CHANGE THIS BACK TO MOBILE.PHP AFTER A/B/ TEST-->
		              </li>
		              <li class=<?php echo $search;?>>
		                <a href="./search.php"><img src="img/icons/searchDark.png" class ="navIcons">search</a>
		              </li>
		              <li class=<?php echo $profile;?>>
		                <a href="./profile.php"><img src="img/icons/userDark.png" class ="navIcons">profile</a>
		              </li>
		              <li class=<?php echo $settings;?>>
		                <a href="./settings.php"><img src="img/icons/settingsDark.png" class ="navIcons">settings</a>
		              </li>
		              <li>
		              	<div class="alert"><p>This is your control panel. Use it to navigate around Balance</p></div>
		            	</li>
		            </ul>
		          </div>
				</div>
		    </div>
		  </div>
		</div>
		
		
		<!-- This is after the header -->
		<div class="container offset" id='final' style="display:none;">
		  <div class="alert">
			<p><strong>One last thing!</strong> <br /> 
				Now that you know more about Balance, take the political quiz to refine and better understand your political ID.</p>
			<a href="./quiz.php"><button type="button" class="btn btn-info btn-large" data-toggle="button">Yes, take me to the quiz</button></a>
			<br /><br />
			<a href="./index.php"><button type="button" class="btn btn-mini" data-toggle="button">No thanks, take me to the home page</button></a>
		  </div>
		</div>
        <div class="container offset" id="tut2">
	       <div class="alert"><p><strong>Welcome to Balance! </strong> <br/> This is a dummy story page. Tap anything to see what it is!</p></div>		       
	       

	       <?php
				include("config.php");
				//Get the ID from the URL argument after .../story.php?id=x
				$id = $_GET["id"];
				
				if ($id == '') {
					$query = "SELECT * FROM balance_stories";
					$all_stories = mysql_query($query);
					$num_stories = mysql_num_rows($all_stories);
					$random_index = rand(1, $num_stories);
					$id = (string)$random_index;
					$_GET["id"] = $id;
				}
				//check for story against db
				$query = sprintf("SELECT * FROM balance_stories WHERE id='%s'", mysql_real_escape_string($id));
				// Perform Query
				$result = mysql_query($query);
				// This tells you how many rows were returned
				$num_rows = mysql_num_rows($result);
				if ($num_rows == 0) {  // if we did not find a single user
					//SET ERROR MESSAGE HERE
					//header("Location: ./login.php?error");
					echo "Error! \nNo stories were found from the database with for your query: ".$query."!\n This is not your search query's fault but a team of acrobatic pokemon have been dispatched to fix our database. Pika!";
					// This below exit code makes the back button and everything nonfunctional because it doesn't execute anything after this point and the javascript is at the bottom :( :(
					//exit();
				} else {
					$row = mysql_fetch_object($result);
				
				$source = $row->source;
				$time = $row->time;
				$social_scale = $row->social_scale;
				$fiscal_scale = $row->fiscal_scale;
				$title = $row->title;
				$picture = "img/stories/".$row->picture;
				$text = $row->text;
				$url = $row->url;
	
	
				//logic to get correct 'ago' time format
				$time = time_ago($time);
				
				// HEADLINE OF STORY
				echo "<h4>".$title."</h4>";
				// source OF STORY, time, social score, fiscal score
				echo "<p class=\"muted small\">".$source.", ".$time
					." "."<a href=\"#\" rel=\"popover\" data-placement=\"bottom\"
data-content=\"This represents this story's social score. Dull colors (light blue, light red, gray) indicate more moderate views while bright colors (bright blue, bright red) represent stronger views. Blue for liberal, and red for conservative.\" data-original-title=\"Article's Social ID\" data-trigger=\"click\">".get_short_social_score_html($row)." "."</a><a href=\"#\" rel=\"popover\" data-placement=\"bottom\"
data-content=\"This represents this story's fiscal score. Dull colors (light blue, light red, gray) indicate more moderate views while bright colors (bright blue, bright red) represent stronger views. Blue for liberal, and red for conservative.\" data-original-title=\"Article's Fiscal ID\" data-trigger=\"click\">".get_short_fiscal_score_html($row)." "."</a>";
				// PIC FOR STORY
				echo "<p><img src=\"".$picture."\" alt=\"alternative text here\"/></p>";
				// BODY OF STORY
				$text = wordwrap($text,100);
				$text = explode("\n",$text);
				$text = $text[0]."... <font size=\"-1\"><p class='muted'>[Article shortened for tutorial purposes]</p></font>";
				
				echo "<p id='text'> ".$text."</p>";
				echo "<a href=\"#text\" rel=\"popover\" data-placement=\"right\"
data-content=\"Clicking this will take you away from the application and open your browser to view the story in its original source\" data-original-title=\"Read In Full Link\" data-trigger=\"click\"><p>Click here to read in full</p></a>";
				echo "<br/>";	
				}
			
			?>

			<ul class="pager">
			  <li class="next" id="finished">
			    <a href="#">That's it for the tutorial. Tap here to start Balancing!   &rarr;</a>
			  </li>
			</ul>
			<br />
			
        </div>

        
		<!-- This is the footer for the story part of the tutorial -->
		
		<!-- This div is a hack to give space between the content and the footer :(-->
		<div class="container footerBuffer"></div>
		
		<!-- Footer start-->
		<div class=" navbar-fixed-bottom ">
		  <div class="navbar">
		    <div class="navbar-inner">
		          <span class="footLogo" id="balance"><img src="img/logofooter.png" class="logo"></span>
		
		      <!-- Alter footer options if viewing a story-->
		      <?php
		        // This is the footer for story
		        echo '<ul class="nav footer">
		        <li><a href="#"><!--<i class="icon-share icon-white">--></i></a></li>
		        <li class="thumbsUp">
					<div id="like">
						<a style="z-index:1000;" href="#like" rel="popover" data-placement="right"
data-content="When you like a story, tap the thumbs up. The more stories you rate the more accurate your political ID will be. Also, the more accurate your ID is, the more relevant your news results will be. <br /><br /><br />" data-original-title="Like" data-trigger="click"><img src="img/logofooter.png" class="hiddenLogo">
						<img src="img/icons/thumbs-up-light.png" /><img src="img/icons/thumbs-up-blue.png" style="display:none"/>
						</a>
			        </div>
		        </li>
		        <li id="balance2">
		        	<a href="#balance2" rel="popover" data-placement="top"
data-content="Tapping this button will give you a random story to read" data-original-title="Balance Button" data-trigger="click">
		        	<img src="img/logofooter.png" class="hiddenLogo">
		        	</a>
		        </li>
		        <li class="thumbsDown">
			        <div id="dislike">
				        <a href="#dislike" rel="popover" data-placement="top"
		data-content="If you disagree with an article\'s stance or just plain don\'t like it, give it the thumbs down. The more stories you rate the more accurate your political ID will be. Also, the more accurate your ID is, the more relevant your news results will be.<br />" data-original-title="Dislike" data-trigger="click"><img src="img/logofooter.png" class="hiddenLogo">
				        <img src="img/icons/thumbs-down-light.png" /><img src="img/icons/thumbs-down-red.png" style="display:none"/>
				        </a>
			        </div>
		        </li>
		        <li><a href="#"><!--<i class="icon-arrow-down icon-white">--></i></a></li>
		      </ul>';
		      ?>
		
		    </div>
		  </div>
		</div>
				
		
		
		
		<!-- The javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});
		</script>




		<!-- This does the js for the buttons just below the header-->
		<!-- WOULD BE COOL IF YOU COULD SWIPE ACROSS TO change THESE too-->
		<script type="text/javascript">
			$('#btnTab a').click(function (e) {
			  	e.preventDefault();
			  $(this).tab('show');
			})






			$('#btnTab a[href="#trending"]').tab('show'); // Select tab by name
			$('#btnTab a:first').tab('show'); // Select first tab
			$('#btnTab a:last').tab('show'); // Select last tab
			$('#btnTab li:eq(2) a').tab('show'); // Select third tab (0-indexed)
		

			$('#finished').click(function (e) {
			  	e.preventDefault();
			  $('#tut2').fadeOut();
			  $('#final').fadeIn();
			})



		</script>




		<!-- Below java script from twitter bootstrap-->
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

		<script src="js/bootstrap-button.js"></script>
	    <script src="js/jquery.js"></script>
	    <script src="js/bootstrap-transition.js"></script>
	    <script src="js/bootstrap-alert.js"></script>
	    <script src="js/bootstrap-modal.js"></script>
	    <script src="js/bootstrap-dropdown.js"></script>
	    <script src="js/bootstrap-scrollspy.js"></script>
	    <script src="js/bootstrap-tab.js"></script>
	    <script src="js/bootstrap-tooltip.js"></script>
	    <script src="js/bootstrap-popover.js"></script>
	    <script src="js/bootstrap-button.js"></script>
	    <script src="js/bootstrap-collapse.js"></script>
	    <script src="js/bootstrap-carousel.js"></script>
	    <script src="js/bootstrap-typeahead.js"></script>
	    <script src="js/bootstrap-affix.js"></script>
	    <script src="js/application.js"></script>

	    <script type="text/javascript">
			$('#btnTab a').click(function (e) {
			  	e.preventDefault();
			  $(this).tab('show');
			})

			$('#btnTab a[href="#trending"]').tab('show'); // Select tab by name
			$('#btnTab a:first').tab('show'); // Select first tab
			$('#btnTab a:last').tab('show'); // Select last tab
			$('#btnTab li:eq(2) a').tab('show'); // Select third tab (0-indexed)
		

			$('#finished').click(function (e) {
			  	e.preventDefault();
			  $('#tut2').hide();
			  $('#final').fadeIn();
			})


						  var like = document.getElementById("like");
  var dislike = document.getElementById("dislike");

  //toggle on the thumbs up & down and make them mutually exclusive
  $("#like").click(function() {
    if (dislike.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs down has been replaced by red
    { 
      $(dislike).find('img').toggle();
    };
      $(this).find('img').toggle();
  });
  $("#dislike").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs down has been replaced by red
    { 
      $(like).find('img').toggle();
    };
      $(this).find('img').toggle();
  });


		</script>

	</body>
</html>