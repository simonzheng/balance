<?php
				$username = $_POST["username"];
				$entered_password = $_POST["password"];


				//salt $entered_password to check in db
				$salt = "kr";
				// This saved_password would be saved in the database.
				$saved_password = crypt($entered_password, $salt); 

				//now check against db
				include("config.php");
				$query = sprintf("SELECT * FROM balance_users WHERE username ='%s' AND password='%s'",
					  mysql_real_escape_string($username),
    				  mysql_real_escape_string($saved_password));
				// Perform Query
				$result = mysql_query($query);
			     // This tells you how many rows were returned
				$num_rows = mysql_num_rows($result);
				if ($num_rows != 1) {  //if we did not find a single user
					//SET ERROR MESSAGE HERE
					header("Location: ./login.php?error");
					exit();								
				} else {
					//SET SESSION HERE if login was correct
					session_save_path('./session/');  //every new session gets stored in a file - NB. this is not very secure
					session_start();
					$row = mysql_fetch_object($result);
					$_SESSION['user_id'] = $row->id; 
				}
			?>
		<!-- At this point, if the login was wrong then the user has been redirected. 
			So if it is right, we arrive here and now set the persistent session info and then redirect-->
		<script type="text/javascript">
			localStorage.setItem("user_id", "<?=$_SESSION['user_id'];?>"); 
			window.location = "./index.php";
		</script>



<!-- THIS IS JUST A TEMPLATE FILE - it does calculations 
	  to decide whether log in was successful or not and redirects appropriately-->
<!DOCTYPE html>
<html>
	<body>
	</body>
</html>