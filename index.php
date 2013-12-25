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
		<script src="//cdn.optimizely.com/js/141317990.js"></script>
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
		<?php
		//partial for the top banner of the page
		$home='"active"';
		$search='""';
		$profile='""';
		$settings='""';
		$back='""';
		include("banner.php");
		?>


        <div class="container firstOffset">
	        <div class="btn-group menu" data-toggle="buttons-radio" id="btnTab" style="text-align: center;">
	  			<a href="#trending" class="btn active">Trending</a>
	  			<a href="#you" class="btn">For you</a>
	 			<a href="#challenge" class="btn">Challenge me</a>
			</div>
		</div>

        <div class="container">
       
        	<div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="trending">
              	
                <?php
				//partial for the trending news results
				include("trending.php");
				?>

              </div>
              <div class="tab-pane fade" id="you">
              	<p class="muted small indexInfo">News matching your political ID: 
              		<?php 
              			include("config.php");
              			$user = getCurrUser();
              			echo get_short_social_score_html($user)." ".get_short_fiscal_score_html($user);
              		?>
              	</p>
              	<?php
				//partial for the trending news results
				include("recommended.php");
				?>
              </div>
              <div class="tab-pane fade" id="challenge">
              	<p class="muted small indexInfo">News outside your political ID: 
              		<?php 
              			include("config.php");
              			$user = getCurrUser();
              			echo get_short_social_score_html($user)." ".get_short_fiscal_score_html($user);
              		?>
              	</p>
              	<?php
				//partial for the trending news results
				include("challengeMe.php");
				?>
              </div>
            </div>
        </div>

        
		
		<?php
		//partial for the footer of the page
		$story=false;
		include("footer.php");
		?>
		
		
		
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



	</body>
</html>