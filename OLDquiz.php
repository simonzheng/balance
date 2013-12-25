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
		$profile='"active"';
		$settings='""';
		include("banner.php");
		?>

			<div class ="container firstOffset">
				 <form action="post_quiz.php" method="post" id="quiz">
				 <fieldset>
    			<legend>Where do you lie on the political spectrum?</legend>
    			<br>
    				<!-- ECON QUESTION-->
    				<h4>Controlling inflation is more important than controlling unemployment.</h4>
					     	<label class="radio muted">  Strongly Agree
							  <input type="radio" name="econRadios1" id="econRadios1.1" value="0">
							</label>
							<label class="radio muted">  Agree
							  <input type="radio" name="econRadios1" id="econRadios1.2" value="30">
							
							</label>
							<label class="radio muted"> Disagree
							  <input type="radio" name="econRadios1" id="econRadios1.3" value="70">

							</label>
							<label class="radio muted">  Strongly Disagree
							  <input type="radio" name="econRadios1" id="econRadios1.4" value="100">
							</label>
						</label>
					<br>
				
					<!-- SOCIAL QUESTION-->
					 <h4>Abortion should be illegal.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios1" id="socRadios1.1" value="100">
					</label>
					<label class="radio muted"> Agree
					  <input type="radio" name="socRadios1" id="socRadios1.2" value="80">
					</label>
					<label class="radio muted"> Disagree
					  <input type="radio" name="socRadios1" id="socRadios1.3" value="20">
					</label>
					<label class="radio muted"> Strongly Disagree
					  <input type="radio" name="socRadios1" id="socRadios1.4" value="0">
					</label>
					<br>

					<!-- ECON QUESTION-->
					 <h4>Because corporations cannot be trusted to voluntarily protect the environment, they require regulation.</h4>
					<label class="radio muted"> Strongly Agree
					  <input type="radio" name="econRadios2" id="optionsRadios2.1" value="0">
					</label>
					<label class="radio muted"> Agree
					  <input type="radio" name="econRadios2" id="optionsRadios2.2" value="30">
					</label>
					<label class="radio muted"> Disagree
					  <input type="radio" name="econRadios2" id="optionsRadios2.3" value="70">
					</label>
					<label class="radio muted"> Strongly Disagree
					  <input type="radio" name="econRadios2" id="optionsRadios2.4" value="100">
					</label>
					<br>


					<!-- SOCIAL QUESTION-->
					 <h4>It is wrong to enforce moral behavior through the law because this infringes upon an individual's freedom.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios2" id="socRadios2.1" value="0">
					</label>
					<label class="radio muted"> Agree
					  <input type="radio" name="socRadios2" id="socRadios2.2" value="20">
					</label>
					<label class="radio muted"> Disagree
					  <input type="radio" name="socRadios2" id="socRadios2.3" value="70">
					</label>
					<label class="radio muted"> Strongly Disagree
					  <input type="radio" name="socRadios2" id="socRadios2.4" value="100">
					</label>
					<br>



					<!-- SOCIAL QUESTION-->
					 <h4>First-generation immigrants can fully integrate within their new country.</h4>
					<label class="radio muted"> Strongly Agree
					  <input type="radio" name="socRadios3" id="socRadios3.1" value="100">
					</label>
					<label class="radio muted"> Agree
					  <input type="radio" name="socRadios3" id="socRadios3.2" value="70">
					</label>
					<label class="radio muted"> Disagree
					  <input type="radio" name="socRadios3" id="socRadios3.3" value="30">
					</label>
					<label class="radio muted"> Strongly Disagree
					  <input type="radio" name="socRadios3" id="socRadios3.4" value="0">
					</label>
					<br>


					<!-- ECON QUESTION-->
					 <h4>"From each according to his ability, to each according to his need" is a fundamentally good idea.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios3" id="econRadios3.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios3" id="econRadios3.2" value="20">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios3" id="econRadios3.3" value="80">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="econRadios3" id="econRadios3.4" value="100">
					</label>
					<br>



					<!-- SOCIAL QUESTION-->
					 <h4>Taxpayers should not prop up any theatres or museums that cannot survive on a commercial basis.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios4" id="socRadios4.1" value="100">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="socRadios4" id="socRadios4.2" value="80">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="socRadios4" id="socRadios4.3" value="20">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="socRadios4" id="socRadios4.4" value="0">
					</label>
					<br>


					<!-- SOCIAL QUESTION-->
					 <h4>Good parents sometimes have to spank their children.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios5" id="socRadios5.1" value="100">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="socRadios5" id="socRadios5.2" value="70">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="socRadios5" id="socRadios5.3" value="30">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="socRadios5" id="socRadios5.4" value="0">
					</label>
					<br>


					<!-- ECON QUESTION-->
					<h4>Land shouldn't be a commodity to be bought and sold.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios4" id="econRadios4.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios4" id="econRadios4.2" value="30">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios4" id="econRadios4.3" value="70">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="econRadios4" id="econRadios4.4" value="100">
					</label>
					<br>

<!-- SOCIAL QUESTION-->
					 <h4> Access to healthcare is a right.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios8" id="socRadios8.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="socRadios8" id="socRadios8.2" value="20">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="socRadios8" id="socRadios8.3" value="80">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="socRadios8" id="socRadios8.4" value="100">
					</label>
					<br>

					<!-- SOCIAL QUESTION-->
					 <h4>There is a need for stricter gun laws.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios6" id="socRadios6.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="socRadios6" id="socRadios6.2" value="20">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="socRadios6" id="socRadios6.3" value="70">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="socRadios6" id="socRadios6.4" value="100">
					</label>
					<br>


					<!-- ECON QUESTION-->
					<h4>Protectionism is sometimes necessary in trade.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios5" id="econRadios5.1" value="100">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios5" id="econRadios5.2" value="60">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios5" id="econRadios5.3" value="40">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="econRadios5" id="econRadios5.4" value="0">
					</label>
					<br>


					<!-- ECON QUESTION-->
					<h4>The only social responsibility of a company should be to deliver a profit to its shareholders.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios6" id="econRadios6.1" value="100">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios6" id="econRadios6.2" value="85">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios6" id="econRadios6.3" value="20">
					</label>
					<label class="radio muted">  Strongly disagree
					  <input type="radio" name="econRadios6" id="econRadios6.4" value="0">
					</label>
					<br>




					<!-- SOCIAL QUESTION-->
					 <h4>Government should ensure that all citizens meet a certain minimum standard of living.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="socRadios7" id="socRadios7.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="socRadios7" id="socRadios7.2" value="25">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="socRadios7" id="socRadios7.3" value="75">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="socRadios7" id="socRadios7.4" value="100">
					</label>
					<br>



					<!-- ECON QUESTION-->
					<h4>The rich should be taxed at a higher rate than the middle class or poor. </h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios7" id="econRadios7.1" value="0">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios7" id="econRadios7.2" value="20">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios7" id="econRadios7.3" value="60">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="econRadios7" id="econRadios7.4" value="85">
					</label>
					<br>



					<!-- ECON QUESTION-->
					<h4>Those with the ability to pay should have the right to higher standards of medical care.</h4>
					<label class="radio muted">  Strongly Agree
					  <input type="radio" name="econRadios8" id="econRadios8.1" value="100">
					</label>
					<label class="radio muted">  Agree
					  <input type="radio" name="econRadios8" id="econRadios8.2" value="75">
					</label>
					<label class="radio muted">  Disagree
					  <input type="radio" name="econRadios8" id="econRadios8.3" value="35">
					</label>
					<label class="radio muted">  Strongly Disagree
					  <input type="radio" name="econRadios8" id="econRadios8.4" value="0">
					</label>
					<br>


					<button class="btn btn-info" type="submit">Submit</button>
				</fieldset>
				</form>
				<br>

			</div>


	<!-- Footer -->
		<?php
		//partial for the footer of the page
		$story=false;
		include("footer.php");
		?>

		
		<!-- The javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});
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
	    
	    
	    <!-- Javascript for form validation -->
	    <script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){

			// Validation
			$("#quiz").validate({
				rules:{
					econRadios1:{required:true},
					econRadios2:{required:true},
					econRadios3:{required:true},
					econRadios4:{required:true},
					econRadios5:{required:true},
					econRadios6:{required:true},
					econRadios7:{required:true},
					econRadios8:{required:true},
					socRadios1:{required:true},
					socRadios2:{required:true},
					socRadios3:{required:true},
					socRadios4:{required:true},
					socRadios5:{required:true},
					socRadios6:{required:true},
					socRadios7:{required:true},
					socRadios8:{required:true}
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
		});
		</script>
	</body>
</html>