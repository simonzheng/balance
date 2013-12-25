<!DOCTYPE html>
<html>

<!-- REGISTER.PHP -->

	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	include("head.php");
	?>

	<body>
	
		

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container">
			<?php 
			$title = "";
			include "reg_log_navbar.php";
			?>

			<div data-role="content">
		

				<form action="post_register.php" method="post" id="register"><fieldset>

					<legend>Register</legend>
					<div class="control-group">
				     	<div class="controls">
				     	<input type="text" name="username" id="username" value="" placeholder="Username..." />
						</div>
					</div>
					
					<div class="control-group">
					     <div class="controls">
					     <input type="password" name="password1" id="password1" value="" placeholder="Password..." />
					     </div>
					</div>

				     <!-- Consider asking for PASSWORD RETYRPE!!!-->
				     <div class="control-group">
					     <div class="controls">
					     <input type="password" name="password2" id="password2" value=""  placeholder="Retype password..."/>
						 </div>
					</div>
					
					<!-- MAY NOT NEED THIS INFO FROM THEM... TOO MUCH???
				     <label for="foo">First Name:</label>
				     <input type="text" name="name" id="foo" value=""  />
				     <label for="foo">Last Name:</label>
				     <input type="text" name="name" id="foo" value=""  />
				      -->
					<div class="control-group">
				     	<div class="controls">
				     	<input type="text" name="email" id="email" value=""  placeholder="Email..."/>
						</div>
					</div>
					<br />
					<div class="btn-center"><button class="btn btn-large btn-info" type="submit" data-theme="a">Register</button></div>
					<br />

				<!--====================================== -->
				<!--======= Moved stuff below to next page in line with the notion of escalation of commitment =========== -->
				<!--
				    <legend>I Identify As Socially:</legend>     	
				   <div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="l" class="btn btn-large btn-block" name="soc">Liberal</button>
 					 	<button type="button" value="m" class="btn btn-large btn-block" name="soc">Moderate</button>
 					 	<button type="button" value="c" class="btn btn-large btn-block" name="soc">Conservative</button>
 					 	<input type="hidden" name="socPref" id="socPref" value="" />
					</div>


				    
				    <legend>I Identify As Fiscally:</legend>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="l" class="btn btn-large btn-block" name="fisc">Liberal</button>
 					 	<button type="button" value="m" class="btn btn-large btn-block" name="fisc">Moderate</button>
 					 	<button type="button" value="c" class="btn btn-large btn-block" name="fisc">Conservative</button>
 					 	<input type="hidden" name="fiscPref" id="fiscPref" value="" />
					</div>
				    <br>
				   
				   ==========END OF MOVED STUFF============-->
				

				</fieldset>
				</form>
			</div>	
		</div>

		


		<!-- JAVASCRIPT -->
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});


		$('form').submit(function() {
		    //left over from when the fom to declare stance was still on this page. We moved it to next page
		    //document.getElementById('fiscPref').value = $('button[name="fisc"].active').val();
			//document.getElementById('socPref').value = $('button[name="soc"].active').val();
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
		
		


		<!-- FORM VALIDATION -->
		<!-- CANNOT FOR THE LIFE OF ME WORK OUT WHY THIS DOESN'T WORK!!! - can't find validate fn
			Found and copied example here: http://www.9lessons.info/2012/04/bootstrap-registration-form-tutorial.html-->
		<!-- Include Bootstrap Asserts JavaScript Files. -->
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript">
		$("#register").submit(function(){
			
			// Validation
			$("#register").validate({
				rules:{
				username:"required",
				email:{required:true,email: true},
				password1:{required:true},
				password2:{required:true,equalTo: "#password1"},
				//socPref:"required",
				//fiscP:"required",
				},

				messages:{
					username:"Please specify a username",
				email:{
					//required:"Enter your email address",
					email:"Enter a valid email address"},
				password1:{
					//required:"Enter your password",
				},
				password2:{
					//required:"Enter confirm password",
					equalTo:"Both passwords must match"},		
				},

				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass)
				{
				$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass)
				{
				$(element).parents('.control-group').removeClass('error');
				//$(element).parents('.control-group').addClass('success');
				}
			});
			if(!$("#register").valid()) {
				return false;
			} else {
				return true;
			}
		});
		</script>




	</body>
</html>