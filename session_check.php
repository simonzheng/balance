<?php 
	ini_set('session.gc_maxlifetime',12*60*60); //make the session last a real long time (in secs)
	ini_set('session.gc_divisor', '1');
	session_save_path('./session/');   //every session gets stored/acessed in a file - NB. this is not very secure
	session_start();

	//Changed below check because the php session times out, and then the user info is lost. This is shitty for UX.
	if (!$_SESSION['user_id']) { //checks to see if we have an active user. If not, redirect
		//Upon login or register we set 'user_id' variable and destroy it upon logout (or if they close the browser)
		header("Location: ./splash.php");
		exit();	 
	}

?>



<!--BELOW is the localStorage logic for session info. We STOPPED using that because it was
	tricky to get the user_id from the localStorage into a php variable.
	But, a benefit of using local storage would be that a session can persist even if someone closes the browser. -->
<!-- <script type="text/javascript">
	 
	try {
		if ( (localStorage.user_id == 'null') || (!localStorage.user_id.match(/\d/)) ) { //no one is logged in. ie. no user_id is set
			window.location = "./splash.php"; //redirects to the splash page if not logged in (ie. no active session)
		}
	} catch(err) { //this happens if the localStorage.user_id is 'undefined' - that is, noone signed in on this browser yet, ever.
		window.location = "./splash.php"; 
	};
	

</script> 
-->

