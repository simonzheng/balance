<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->



<!DOCTYPE html>
<html>

<!-- SEARCH.PHP -->

	<?php
	//'head.php' includes all header information for all of our pages
	// ie. everything that lives within <head>...info..</head> 
	include("head.php");
	?>

	<body>
	
		<?php
		//partial for the top banner of the page
		$home='""';
		$search='"active"';
		$profile='""';
		$settings='""';
		include("banner.php");
		?>

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container firstOffset">



			<form class="form-search searchForm searchForm1" action="search_result.php" id="search" name="search" method="post">
  			   <div class="input-append searchBox">
			    <input type="text" class="span2 search-query" id="query" name="query" placeholder="Search..." onkeyup="query_onkeyup()">
			    <button type="submit" class="btn searchBtn"><i class="icon-search"></i></button>
			  </div>
			</form>
			<div class="muted" style="margin-left:auto; margin-right:auto; width:83%;">Begin your search for a story above.</p>
		
		</div>

		<!-- Footer -->
		<?php
		//partial for the footer of the page
		$story=false;
		include("footer.php");
		?>
		
		
		
		<script type="text/javascript">
		$("a").click(function (event) {
		    event.preventDefault();
		    window.location = $(this).attr("href");
		});

		//document.getElementById("clearer").style.display = "none";


		//The following function appends some html containers and an icon that clears the text field when pressed
		//inspiration for this was take from: http://jsfiddle.net/PvFSF/  - creative commons
		(function ($, undefined) {
		    $.fn.clearable = function () {
		        var $this = this;
		        $this.wrap('<div class="clear-holder" />');
		        var helper = $('<span class="clear-helper" id="clearer" style="display:none;"><img src="img/icons/clear.png" class="clearImg"></span>');
		        $this.parent().append(helper);
		        helper.click(function(){
		            $this.val("");
		            $("#clearer").fadeOut("fast");
		        });
		    };
		})(jQuery);
		
		$("#query").clearable();
		

		function query_onkeyup() 
		{
			var text = document.getElementById("query");
		   	if (text.value == "") {
		   		$("#clearer").fadeOut("fast");
		   	} else if (text.value != "") {
		   		$("#clearer").fadeIn("fast");
		   	};
		   
		}



		</script>


				<!-- Below java script from twitter bootstrap-->
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		<script type="text/javascript">
		$("#search").submit(function(){
			
			// Validation
			$("#search").validate({
				rules:{
				query:{required:true},
				},

				messages:{
					query:"Please specify a username",
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
			if(!$("#search").valid()) {
				return false;
			} else {
				return true;
			}
		});
		</script>


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