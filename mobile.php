<?php
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
	include("head.php");
	?>

	<body>
	
		<!-- Note,back button to the header... make invisible on homepage??? -->
		<?php
		//partial for the top banner of the page
		$home='"active"';
		$search='""';
		$profile='""';
		$settings='""';
		include("banner.php");
		?>


        <div class="container firstOffset">
	        <div class="btn-group menu" data-toggle="buttons-radio" id="btnTab">
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
              	<?php
				//partial for the trending news results
				include("recommended.php");
				?>
              </div>
              <div class="tab-pane fade" id="challenge">
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