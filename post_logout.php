<?php 
	ini_set('session.gc_maxlifetime',12*60*60); //make the session last a real long time
	ini_set('session.gc_divisor', '1');
	session_save_path('./session/');   //every session gets stored in a file - NB. this is not very secure

	session_start();
	session_destroy(); //ends session for logout
?>

<script type="text/javascript">
	window.localStorage.clear();  //clear all session info
	localStorage.setItem('user_id', null);
	window.location = "./splash.php?logout"; //sets logout confirm message with url query 'logout'
</script>

<!-- this file just confirms logout, ends the session and then redirects to the splash page-->

<!DOCTYPE html>
<html>
	<body>
	</body>
</html>