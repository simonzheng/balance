<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->


<!DOCTYPE html>
<html>

<!-- SETTINGS.PHP -->

	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	include("head.php");
	?>

	<body>
	
		<?php
		//partial for the top banner of the page
		$home='""';
		$search='""';
		$profile='""';
		$settings='"active"';
		include("banner.php");
		?>

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container firstOffset">
			
		

			<!-- AMIT's awesome work lives in here-->
			 <!-- This is the collapse-able About Us box -->
				<div class="accordion story" id="accordion2">
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				        About Balance
				      </a>
				    </div>
				    <div id="collapseOne" class="accordion-body collapse">
				      <div class="accordion-inner">
				        In the face of increasingly polarized news where the most extreme voices are the loudest, Balance gives you access to a spectrum of views to help you form a balanced opinion.
				        <br /><br />
				        We are a team of Stanford students hoping to levarage mobile media consumption to help readers be more informed, more aware and more balanced. 
				      </div>
				    </div>
				  </div>
				  
				  <!-- This is the collapse-able Tutorial box -->
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
				        Tutorial
				      </a>
				    </div>
				    <div id="collapseTwo" class="accordion-body collapse">
				      <div class="accordion-inner">
				        Explore different aspects of the app, get to know the labeling system like a pro and find out how we learn your political preferences. 
				        <br /><a href="tutorial_pg1.php" id="key" data-icon="custom">Take the interactive tutorial</a>
				      </div>
				    </div>
				  </div>
				  
				   <!-- This is the collapse-able Contact Us box -->
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
				        Contact Us
				      </a>
				    </div>
				    <div id="collapseThree" class="accordion-body collapse">
				      <div class="accordion-inner">
				        We'd love to hear from you. <a href="mailto:sax@balance.com?Subject=Hello Balance!">Let us know</a> how we're doing or what we could improve on.
				      </div>
				    </div>
				  </div>
				  
				  <!-- This is the collapse-able Logout box -->
				  <div class="accordion-group">
				    <div class="accordion-heading">
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="./post_logout.php">
				        <strong>Log Out</strong>
				      </a>
				    </div>
				    <div id="collapseFour" class="accordion-body collapse">
				      <div class="accordion-inner">
				        Are you sure you want to logout? Click <a href="./post_logout.php">
here </a> to logout!
				      </div>
				    </div>
				  </div>

				</div>

		<!-- Footer -->
		<?php
		//partial for the footer of the page
		$story=false;
		include("footer.php");
		?>
		
		
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});
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