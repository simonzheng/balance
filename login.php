<!DOCTYPE html>
<html>

<!-- LOGIN.PHP -->

	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	include("head.php");
	?>

	<body>
	
		

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container">
			<!-- little header part--> 
          	<?php 
			$title = "";
			include "reg_log_navbar.php";
			?>

			<div data-role="content">

			<?php 
				if (isset ($_GET['error']))
				{
				   echo '<div class="alert alert-error">Oops, we could not find you in our system. Please try again.</div>';
				}
			?>
			<br />
			<form id="form" action="post_login.php" method="post">
				<div data-role="fieldcontain">
			     <input type="text" name="username" id="username" value="" autocapitalize="off" placeholder="Username..."/>
				</div>
				<div data-role="fieldcontain">
			     <input type="password" name="password" id="pwd" value=""  placeholder="Password..."/>
				</div>
				<br />
				<div class="btn-center"><button class="btn btn-large btn-info" type="submit" data-theme="b" name="submit" value="submit-value">Log in</button></div>
			</form>
			<a class="plain" href="mailto:sax@balance.com?Subject=Uh oh!&body=Eek, please help me, I forgot my password.">Forgot password?</a>
			<br><br>

			

			</div>
		
		
		
		</div>

		
		
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