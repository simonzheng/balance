<?php 
	ini_set('session.gc_maxlifetime',12*60*60); //make the session last a real long time (in secs)
	ini_set('session.gc_divisor', '1');
	session_save_path('./session/');   //every session gets stored/acessed in a file - NB. this is not very secure
	session_start();

	//Changed below check because the php session times out, and then the user info is lost. This is shitty for UX.
	if ($_SESSION['user_id']) { //checks to see if we have an active user. If not, redirect
		//Upon login or register we set 'user_id' variable and destroy it upon logout (or if they close the browser)
		header("Location: ./index.php");
		exit();	 
	}

?>

<!DOCTYPE html>
<html>

<!-- SPLASH.PHP  - MAKE A USER ARRIVE HERE if they go to index.php but do not have an active session -->

	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	include("head.php");
	?>

	<body>

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container">
			<div><br /><br /></div>
			<h1><img src="img/logo.png" class="logo splash"> Balance</h1>

			<?php 
				if (isset ($_GET['logout']))
				{
				   echo '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>You have been successfully logged out!</div>';
				}
			?>

			<div data-role="content">
			<p> Welcome! Please login or register.</p>
			<br />
			<br />
			<a class="plain" href="login.php"><button class="btn btn-large btn-block btn-info" id="huge1" type="button">Login</button></a>
			<br>
			<a class="plain" href="register.php"><button class="btn btn-large btn-block" id="huge2" type="button">Register</button></a>
				
			</div>
		
		
		
		</div>


		
		



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
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});
		</script>

	</body>
</html>