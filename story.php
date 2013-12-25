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
	
		<?php
		//partial for the top banner of the page
		$home='""';
		$search='""';
		$profile='""';
		$settings='""';
		$back = "back";
		include("banner.php");
		?>


		<div class="container firstOffset">
		
		<?php
	        include("config.php");
	        $user = getCurrUser();
        	
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
			// source OF STORY
			echo "<p class=\"muted small\">".$source.", ".$time
				."   ".get_short_social_score_html($row)." ".get_short_fiscal_score_html($row);
			// PIC FOR STORY
			echo "<p><img src=\"".$picture."\" alt=\"alternative text here\"/></p>";
			// BODY OF STORY
			echo "<p> ".$text."</p>";
			echo "<p><a href=\"".$url."\" target=\"_blank\">Click here to read in full.</a></p>";
			echo "<br />";
			

			//--Insert this story into the db as read!--
			$user = getCurrUser(); //get user - helper fn from 'helper_fns.php'
			$storiesString = $user->stories_read;  //get user's stories
			$storiesString = $row->id.",".$storiesString; //update their stories
			include("config.php"); //put the updated stories list back into db
			$query = sprintf("UPDATE balance_users SET stories_read='%s' WHERE id=%d",
				mysql_real_escape_string($storiesString),
				mysql_real_escape_string($_SESSION['user_id'])
			);
			// Actually update db now
			$result = mysql_query($query);


			}
		
		?>

		</div>




		<?php
		//partial for the footer of the page
		$story=true;
		include("footer.php");
		?>
		
		
		
		<!-- The javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript">
		/* Below exists in all of our pages - something we carried over from RIO
		BUT it was fucking up the like/dislike stuff so removed it for 'Story.php' only
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		}); */
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