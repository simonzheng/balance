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
	$strongly_agree_text = "Strongly Agree";
	$agree_text = "Agree";
	$neutral_text = "Neutral";
	$disagree_text = "Disagree";
	$strongly_disagree_text = "Strongly Disagree";

	?>

<body>
	<div class ="container">

			<div><img src="img/icons/back.png" class="backBtnQuiz" id="back">
				<img src="img/logo.png" class="logoQuiz">
			</div>
			<br /><br />
			<div class="progress progress-info progress-striped">
  				<div id="progressBar" class="bar" style="width: 6.25%"></div>	
			</div>

			<form action="post_quiz.php" method="post" id="quiz">
				<fieldset>
				<div id="1">
				    <h4>Q1. Controlling inflation is more important than controlling unemployment.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="1"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="30" class="btn btn-large btn-block" name="1"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="1"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="1"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="1"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ1" id="econ1" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="2" class="hide">
				    <h4>Q2. Abortion should be illegal.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="2"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="80" class="btn btn-large btn-block" name="2"><?php echo $agree_text ?></button>
 					 	<button type="button" value="40" class="btn btn-large btn-block" name="2"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="2"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="2"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc1" id="soc1" value="50" />
 						<br />
 					</div>
 				</div>
				   	
 				<div id="3" class="hide">
				    <h4>Q3. Because corporations cannot be trusted to voluntarily protect the environment, they require regulation.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="3"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="30" class="btn btn-large btn-block" name="3"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="3"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="3"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="3"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ2" id="econ2" value="50" />
 						<br />
 					</div>
 				</div>				   


 				<div id="4" class="hide">
				    <h4>Q4. It is wrong to enforce moral behavior through the law because this infringes upon an individual's freedom.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="4"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="4"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="4"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="4"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="4"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc2" id="soc2" value="50" />
 						<br />
 					</div>
 				</div>

 				 <div id="5" class="hide">
				    <h4>Q5. First-generation immigrants should not be required to fully integrate within their new country.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="5"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="30" class="btn btn-large btn-block" name="5"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="5"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="5"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="5"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc3" id="soc3" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="6" class="hide">
				    <h4>Q6. "From each according to his ability, to each according to his need" is a fundamentally good idea.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="6"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="6"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="6"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="80" class="btn btn-large btn-block" name="6"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="6"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ3" id="econ3" value="50" />
 						<br />
 					</div>
 				</div>

 				 <div id="7" class="hide">
				    <h4>Q7. Taxpayers should not prop up any theatres or museums that cannot survive on a commercial basis.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="7"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="80" class="btn btn-large btn-block" name="7"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="7"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="7"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="7"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc4" id="soc4" value="50" />
 						<br />
 					</div>
 				</div>

 				<div id="8" class="hide">
				    <h4>Q8. Good parents sometimes have to spank their children.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="8"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="8"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="8"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="30" class="btn btn-large btn-block" name="8"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="8"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc5" id="soc5" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="9" class="hide">
				    <h4>Q9. Land shouldn't be a commodity to be bought and sold.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="-10" class="btn btn-large btn-block" name="9"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="9"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="9"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="60" class="btn btn-large btn-block" name="9"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="80" class="btn btn-large btn-block" name="9"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ4" id="econ4" value="50" />
 						<br />
 					</div>
 				</div>

 				<div id="10" class="hide">
				    <h4>Q10. Access to healthcare is a right.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="10"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="10"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="10"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="80" class="btn btn-large btn-block" name="10"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="10"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc8" id="soc8" value="50" />
 						<br />
 					</div>
 				</div>

 				 <div id="11" class="hide">
				    <h4>Q11. There is a need for stricter gun laws.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="11"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="11"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="11"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="70" class="btn btn-large btn-block" name="11"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="11"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc6" id="soc6" value="50" />
 						<br />
 					</div>
 				</div>

 				 <div id="12" class="hide">
				    <h4>Q12. Protectionism is sometimes necessary in trade.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="12"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="60" class="btn btn-large btn-block" name="12"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="12"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="40" class="btn btn-large btn-block" name="12"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="12"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ5" id="econ5" value="50" />
 						<br />
 					</div>
 				</div>

 				 <div id="13" class="hide">
				    <h4>Q13. The only social responsibility of a company should be to deliver a profit to its shareholders.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="110" class="btn btn-large btn-block" name="13"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="85" class="btn btn-large btn-block" name="13"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="13"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="13"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="13"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ6" id="econ6" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="14" class="hide">
				    <h4>Q14. Government should ensure that all citizens meet a certain minimum standard of living.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="14"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="25" class="btn btn-large btn-block" name="14"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="14"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="75" class="btn btn-large btn-block" name="14"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="14"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="soc7" id="soc7" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="15" class="hide">
				    <h4>Q15. The rich should be taxed at a higher rate than the middle class or poor.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="15"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="15"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="15"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="60" class="btn btn-large btn-block" name="15"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="85" class="btn btn-large btn-block" name="15"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ7" id="econ7" value="50" />
 						<br />
 					</div>
 				</div>

 				<div id="16" class="hide">
				    <h4>Q16. Those with the ability to pay should have the right to higher standards of medical care.</h4>
				   	<div class="btn-group"  data-toggle="buttons-radio">
 					 	<button type="button" value="100" class="btn btn-large btn-block" name="16"><?php echo $strongly_agree_text ?></button>
 					 	<button type="button" value="75" class="btn btn-large btn-block" name="16"><?php echo $agree_text ?></button>
 					 	<button type="button" value="50" class="btn btn-large btn-block" name="16"><?php echo $neutral_text ?></button>
 					 	<button type="button" value="20" class="btn btn-large btn-block" name="16"><?php echo $disagree_text ?></button>
 					 	<button type="button" value="0" class="btn btn-large btn-block" name="16"><?php echo $strongly_disagree_text ?></button>

 					 	<input type="hidden" name="econ8" id="econ8" value="50" />
 						<br />
 					</div>
 				</div>


 				<div id="submit" class="hide">
 					<br />
 					<br />
 					 <div class="btn-center"><button class="btn btn-large" type="submit" data-theme="a">Show me where I stand!</button>
 					 </div>
					<br />
 				</div>

				</fieldset>
				</form>



	</div>


	<!-- The javascript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});


			$('form').submit(function() {
		    //document.getElementById('fiscPref').value = $('button[name="fisc"].active').val();
			//document.getElementById('socPref').value = $('button[name="soc"].active').val();
		});

		var currQ = '1';
		$('#back').click(function (e) {
  			e.preventDefault();
  			if (currQ == '1') {
  				history.go(-1);
  			} else {
		  		document.getElementById(currQ).style.display = 'none';
		  		var prevQ = parseInt(currQ) - 1;
		  		currQ = prevQ.toString();
		  		var newID = '#'.concat(currQ);
		  		$(newID).fadeIn();
		  		document.getElementById('progressBar').style.width = (6.25*prevQ).toString().concat('%'); 

			};
		});


		$('#1 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('1').style.display = 'none';
  		$("#2").fadeIn();
  		currQ = '2';
  		document.getElementById('progressBar').style.width = '12.5%'; 
		});

		$('#2 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('2').style.display = 'none';
  		$("#3").fadeIn();
  		currQ = '3';
  		document.getElementById('progressBar').style.width = '18.75%'; 
		});

		$('#3 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('3').style.display = 'none';
  		$("#4").fadeIn();
  		currQ = '4';
  		document.getElementById('progressBar').style.width = '25%'; 
		});

		$('#4 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('4').style.display = 'none';
  		$("#5").fadeIn();
  		currQ = '5';
  		document.getElementById('progressBar').style.width = '31.25%'; 
		});

		$('#5 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('5').style.display = 'none';
  		$("#6").fadeIn();
  		currQ = '6';
  		document.getElementById('progressBar').style.width = '37.5%'; 
		});

		$('#6 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('6').style.display = 'none';
  		$("#7").fadeIn();
  		currQ = '7';
  		document.getElementById('progressBar').style.width = '43.75%'; 
		});

		$('#7 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('7').style.display = 'none';
  		$("#8").fadeIn();
  		currQ = '8';
  		document.getElementById('progressBar').style.width = '50%'; 
		});

		$('#8 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('8').style.display = 'none';
  		$("#9").fadeIn();
  		currQ = '9';
  		document.getElementById('progressBar').style.width = '56.25%'; 
		});

		$('#9 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('9').style.display = 'none';
  		$("#10").fadeIn();
  		currQ = '10';
  		document.getElementById('progressBar').style.width = '62.5%'; 
		});

		$('#10 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('10').style.display = 'none';
  		$("#11").fadeIn();
  		currQ = '11';
  		document.getElementById('progressBar').style.width = '68.75%'; 
		});


		$('#11 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('11').style.display = 'none';
  		$("#12").fadeIn();
  		currQ = '12';
  		document.getElementById('progressBar').style.width = '75%'; 
		});

		$('#12 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('12').style.display = 'none';
  		$("#13").fadeIn();
  		currQ = '13';
  		document.getElementById('progressBar').style.width = '81.25%'; 
		});

		$('#13 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('13').style.display = 'none';
  		$("#14").fadeIn();
  		currQ = '14';
  		document.getElementById('progressBar').style.width = '87.5%'; 
		});

		$('#14 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('14').style.display = 'none';
  		$("#15").fadeIn();
  		currQ = '15';
  		document.getElementById('progressBar').style.width = '93.75%'; 
		});

		$('#15 button').click(function (e) {
  			e.preventDefault();
  		document.getElementById('15').style.display = 'none';
  		$("#16").fadeIn();
  		currQ = '16';
  		document.getElementById('progressBar').style.width = '100%'; 
		});


		//ANSWERING THE FINAL QUESTION SUBMITS
		$('#16 button').click(function (e) {
  			e.preventDefault();
  			document.getElementById('16').style.display = 'none';
  			$("#submit").fadeIn();
  		});

  		$('form').submit(function() {
	  		//set all the values
	  		document.getElementById('econ1').value = $('button[name="1"].active').val();
	  		document.getElementById('econ2').value = $('button[name="3"].active').val();
	  		document.getElementById('econ3').value = $('button[name="6"].active').val();
	  		document.getElementById('econ4').value = $('button[name="9"].active').val();
	  		document.getElementById('econ5').value = $('button[name="12"].active').val();
	  		document.getElementById('econ6').value = $('button[name="13"].active').val();
	  		document.getElementById('econ7').value = $('button[name="15"].active').val();
	  		document.getElementById('econ8').value = $('button[name="16"].active').val();

			document.getElementById('soc1').value = $('button[name="2"].active').val();
			document.getElementById('soc2').value = $('button[name="4"].active').val();
			document.getElementById('soc3').value = $('button[name="5"].active').val();
			document.getElementById('soc4').value = $('button[name="7"].active').val();
			document.getElementById('soc5').value = $('button[name="8"].active').val();
			document.getElementById('soc6').value = $('button[name="11"].active').val();
			document.getElementById('soc7').value = $('button[name="14"].active').val();
			document.getElementById('soc8').value = $('button[name="10"].active').val();

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
	    

	</body>
</html>