<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->

<?php
	include "config.php";
	//THE MACHINE LEARNING PART THAT MOVES YOU SCORE CLOSER TO AN ARTICLE
	// the function lives in helper_fns
	adjustUserScore($_GET["id"]);   //NB. a liked story has its normal ID, a disliked story has a -ve ID.
	if ($_GET["page"]=="reload") {
		$redirect = "history.go(-1);";
	} elseif ($_GET["page"]=="back") {
		$redirect = "window.history.go(-2);";  //goes back 2: back to story -> back to page prev to story
	} else {
		$redirect = "window.location = './".$_GET["page"].".php';";
	}


	//--Insert this story into the db as liked/disliked--
			$user = getCurrUser(); //get user - helper fn from 'helper_fns.php'
			$storiesLikedStr = $user->stories_liked;  //get user's stories
			$storiesLikedStr = $_GET["id"].",".$storiesLikedStr; //update their stories
			//put the updated stories list back into db
			$query = sprintf("UPDATE balance_users SET stories_liked='%s' WHERE id=%d",
				mysql_real_escape_string($storiesLikedStr),
				mysql_real_escape_string($_SESSION['user_id'])
			);
			// Actually update db now
			$result = mysql_query($query);

?>

<!DOCTYPE html>
<html>
<body>
		<script type="text/javascript">
			<?php echo $redirect; ?>
		</script>
</body>
</html>