<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->

		
<?php
	//user gets a soc score out of $numQuestions * 100 (can get total of 100 per question)
	//and fisc score out of $numQuestions * 100
	//We will store a number out of 100 - where we know that >50 is conservative and <50 is liberal
	
		$numQuestions = 5; //must have equal nums fisc/soc questions
		$econScore = 0;
		$socScore = 0;
		$quizIsComplete = True;
		for ($i=1; $i<=$numQuestions; $i++)
		{
			$econVal = $_POST["econ".(string)$i.""];
			$socVal = $_POST["soc".(string)$i.""];

			if ($econVal == '') {
				echo "You have not completed fiscal question #".((string)$i)."<br/>"; // This will only show up in the post_quiz.php page which is loaded briefly before redirecting to profile.php?quiz_results page. To see this, comment out the window.location code at the bottom.
				$quizIsComplete = False;
			}
			
			if ($socVal == '') {
				echo "You have not completed social question #".((string)$i)."<br/>"; // This will only show up in the post_quiz.php page which is loaded briefly before redirecting to profile.php?quiz_results page. To see this, comment out the window.location code at the bottom.
				$quizIsComplete = False;
			}
			
			$econScore += (int)$econVal;
			$socScore += (int)$socVal; 
			
		}
		$normalizedSocScore = ($socScore/($numQuestions*100))*100;
		$normalizedEconScore = ($econScore/($numQuestions*100))*100;

		//now put the score into the db. and redirect to profile page
		include("config.php");
		$query = sprintf("UPDATE balance_users SET fiscal_scale=%d, social_scale=%d WHERE id=%d",
			mysql_real_escape_string($normalizedEconScore),
			mysql_real_escape_string($normalizedSocScore),
			mysql_real_escape_string($_SESSION['user_id'])
			);
		// Actually update db now
		$result = mysql_query($query);
	
?>
		<script type="text/javascript">
		//SET quiz confirm MESSAGE HERE	
		<?php if ($quizIsComplete) { ?>
			window.location = "./profile.php?post_quiz";
		<?php } else { ?>
			window.location = "./quiz.php?unfinished_quiz"
		<?php }
		?>
		</script>


<!DOCTYPE html>
<html>
	<body>
	</body>
</html>