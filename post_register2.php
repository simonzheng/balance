<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->


<?php 
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


	//now update db with scores
	include("config.php");
		$query = sprintf("UPDATE balance_users SET fiscal_scale=%d, social_scale=%d WHERE id=%d",
			mysql_real_escape_string($fiscScore),
			mysql_real_escape_string($socScore),
			mysql_real_escape_string($_SESSION['user_id'])
			);
		// Actually update db now
		$result = mysql_query($query);


?>



<!-- Now set the persistent info for the session-->
<script type="text/javascript">
    window.location = "./tutorial_pg1.php"; //redirects to the home page after succesful registration
</script>