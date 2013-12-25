<?php
	$username = $_POST["username"];   //NOTE: do we want to make this unique!!!
	$entered_password = $_POST["password1"];
	//salt then crypt $entered_password to save in db, salt should be unique for each user. Is not right now!
	//Consider building this out. For now, each user has the same salt. Not terribly safe.
	$salt = "kr";
	// This password_to_save will be saved in the database.
	$password_to_save = crypt($entered_password, $salt);

	$email = $_POST["email"];
	$socScore = $_POST["socPref"];
	$fiscScore = $_POST["fiscPref"];

	//Normalize the user's soc and fisc score based on what they said
	//ie. place them in the middle of the quadrant of the graph that fits 
	//their answers to the two questions we asked so they get 1/4 or 3/4 for each Q.
	//NOTE: fiscal conservative = more, liberal = less on our graph
	//soc conservative = more, liberal = less
	if ($socScore == 'c') {
		$socScore = 75;
	} else if($socScore == 'l'){
		$socScore = 25;   //MUST CHANGE THIS IF WE CHANGE THE SCORING SYSTEM
	} else {
		$socScore = 50;
	}
	if ($fiscScore == 'c') {
		$fiscScore = 75;
	} else if($fiscScore == 'l'){
		$fiscScore = 25;   //MUST CHANGE THIS IF WE CHANGE THE SCORING SYSTEM
	} else {
		$fiscScore = 50;
	}


	//now insert into db
	include("config.php");
	$query = sprintf("INSERT INTO balance_users (username, password, email, social_scale, fiscal_scale) VALUES ('%s','%s','%s',%d,%d)",
		mysql_real_escape_string($username),
		mysql_real_escape_string($password_to_save),
		mysql_real_escape_string($email),
		mysql_real_escape_string($socScore),
		mysql_real_escape_string($fiscScore) 
		);
	// Actually add into to db now
	$result = mysql_query($query);

	//now get that user out of db to input info into session
	$userQuery = sprintf("SELECT * FROM balance_users WHERE username ='%s' AND password='%s'",
			mysql_real_escape_string($username),
    		mysql_real_escape_string($password_to_save));
	// Perform Query
	$resultRow = mysql_query($userQuery);
	$user = mysql_fetch_object($resultRow);


	//SET SESSION HERE - NOW - start the session and redirect to 'profile'????
	session_save_path('./session/');  //every new session gets stored in a file - NB. this is not very secure
	session_start();

	$_SESSION['user_id'] = $user->id; 
	?>

<!-- Now set the persistent info for the session-->
<script type="text/javascript">
	localStorage.setItem('user_id', '<?=$_SESSION["user_id"];?>');   //sets info for the persistent session
    //window.location = "./index.php"; //redirects to the home page after succesful registration
</script>




<!-- THIS IS JUST A TEMPLATE FILE - it does calculations 
	to decide whether log in was successful or not and redirects appropriately-->
<!DOCTYPE html>
	<html>
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

				<form action="post_register2.php" method="post" id="register"><fieldset>
				<legend>I identify as socially:</legend>     	
				   <div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="l" class="btn btn-large btn-block" name="soc">Liberal</button>
 					 	<button type="button" value="m" class="btn btn-large btn-block active" name="soc">Moderate</button>
 					 	<button type="button" value="c" class="btn btn-large btn-block" name="soc">Conservative</button>
 					 	<input type="hidden" name="socPref" id="socPref" value="" />
					<br />
					</div>
				    
				    <legend>I identify as fiscally:</legend>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="l" class="btn btn-large btn-block" name="fisc">Liberal</button>
 					 	<button type="button" value="m" class="btn btn-large btn-block active" name="fisc">Moderate</button>
 					 	<button type="button" value="c" class="btn btn-large btn-block" name="fisc">Conservative</button>
 					 	<input type="hidden" name="fiscPref" id="fiscPref" value="" />
 					<br />
					</div>
				</div>

				   	<div class="btn-center"><button class="btn btn-large btn-info" type="submit" data-theme="a">Submit</button></div>
					<br />
				   


				</fieldset>
				</form>

		<!-- JAVASCRIPT -->
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});


		$('form').submit(function() {
		    document.getElementById('fiscPref').value = $('button[name="fisc"].active').val();
			document.getElementById('socPref').value = $('button[name="soc"].active').val();
		});

		</script>

		<!-- JAVASCRIPT -->
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