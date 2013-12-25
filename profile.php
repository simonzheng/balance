<?php
	//'session_check.php' checks if the session is active and if not 
	// redirects to the splash page
	include("session_check.php");
?>
<!-- SESSION: ABOVE MUST BE PLACED AT VERY BEGINNING OF FILE BEFORE ANYTHING GET'S OUTPUTTED TO BROWSER -->


<!DOCTYPE html>
<html>
	<!-- PROFILE.PHP --></html>

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
		$search='""';
		include("banner.php");
		?>

		<!-- PLACE BODY INSIDE HERE - this is within the header and the footer-->
		<div class="container firstOffset">

			<?php 
				if (isset ($_GET['post_quiz']))
				{
				   echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>Thanks for taking the quiz! Take a look at your results below</div>';
				}
			
			//get the user object from the db
			include("config.php");
			$user = getCurrUser(); //get user - helper fn from 'helper_fns.php'
		
				//--------------------------------
				//-- BELOW IS FOR THE USER'S SCORE! --
				//--------------------------------

			?>
		<div class="colorContainer">
			<?php echo testdisplayUserScore($user)?>
			<div id="loader"></div>
			<!-- FOR THE GRAPH!!!! This get's modified on the fly by jscript-->
			<div id="graph"></div>
		</div>
			<div class="scrollCircles" id="scroller">
				<img src="./img/icons/activeCirlce.png" class="activeCircle" id="leftCircle"/>
				<img src="./img/icons/activeCirlce.png" class="inactiveCircle" id="middleCircle"/>
				<img src="./img/icons/activeCirlce.png" class="inactiveCircle" id="rightCircle"/>
			</div>
			<br />
			<p>Refine your political ID:
			<a href="quiz.php" class="btn btn btn-info">Take the quiz!</a></p>
			<a href="#help" class="btn" rel="popover" data-placement="bottom" data-trigger="click"
				data-content="
				<p class='muted small'>Your political ID exists on a spectrum between Liberal and Conservative in both fiscal and social issues.<br/><br />
				<strong>Fiscally Liberal</strong>: You support government-funded programs and believe that the state has a responsibility to improve social welfare.<br/><br />
				<strong>Fiscally Conservative</strong>: You likely believe in less government intervention, free market dynamics and lassaiz-faire.<br/><br />
				<strong>Socially Liberal</strong>: You like government to focus on areas like expanding civil and political rights. Perhaps you are pro-choice or support marriage equality and affirmative action.<br/><br />
				<strong>Socially Conservative</strong>: You like to preserve traditional values and may agree that pro-life, gun ownership, and school prayer are important touchstones for society.
				</p>" 
				>What is the political spectrum?
			</a>
			<br /><br />
			<p class="lead">Recommended reads</p>
			<?php 
				include("config.php");

				$user = getCurrUser();
				$storiesString = $user->stories_read;  //get user's stories
				$storiesArr = explode(',', $storiesString); //put all read stories into array
				
				//--------------------------------
				// --- RECOMMENDED READS PART  ---
				//--------------------------------
				//selects the recomended only!! - query targets only stories within some threshold proxitmity to the users preferences
				//NOTE: this logic is very similar to what's used in the home page 'for you' section. Please mirror changes in both places
				$sql_query = sprintf("SELECT * FROM balance_stories 
										WHERE abs(fiscal_scale - %d)<30 AND abs(social_scale - %d)<30
										ORDER BY RAND() LIMIT 5",
					mysql_real_escape_string($user->fiscal_scale),
					mysql_real_escape_string($user->social_scale)
					);
				$result = mysql_query($sql_query);
				$outputStories= 0;
				while ($row = mysql_fetch_assoc($result)) { //loops through results and output list
					if (!(in_array($row['id'], $storiesArr))) { 
					//the if above makes sure we don't recommend something they've already read!
						echo output_story_brief($row); //this sneaky little function lives in 'helper_fns.php'
									// it takes in a row object from the stories db
									// and outputs the html for the story in list format 
						$outputStories += 1;
					}
				}
				if ($outputStories == 0) { //we have nothing to recommend or they have read all recommendations
					echo "<p class='muted'>You're up to date on all recommended reads. 
						Why don't you try something new? Start balancing by clicking <img src='img/logo.png' class='minilogo'> below.</p>";
				}

				//--------------------------------
				// --- RECENTLY READ PART  ---
				//--------------------------------
				echo "<p class='lead'>Recently read</p>";
				$storiesList = substr($storiesString, 0, -1); //get rid of comma at end
				$storiesList = "( ".$storiesList." )";
				if ($storiesString =="") {  //this would be true if the user is new (no stories read yet)
					echo "<p class='muted'>You haven't read anything yet. Get started by clicking <img src='img/logo.png' class='minilogo'> below.</p>";
				}
				else { //has read some stories
					$displayed = array();
					for ($i=0; $i < 4; $i++) { 
						$subquery = sprintf("SELECT * FROM balance_stories WHERE id = %s",
        					mysql_real_escape_string($storiesArr[$i])); //constructs query	
						$subResult = mysql_query($subquery); //finds the result from db for this story
        				if (($subResult != false) && (array_search($storiesArr[$i], $displayed)===false)) {	 
        					//ensures $i gives something and we haven;t already printed it		
							$singleResult = mysql_fetch_assoc($subResult); 
							echo output_story_brief($singleResult); //output it!
							array_push($displayed, $storiesArr[$i]);
						}	
					}				
				}
			?>
			
			<br><br>
		</div>



	<!-- Footer -->
		<?php
		//partial for the footer of the page
		$story=false;
		include("footer.php");
		?>



	<!-- STUFF FOR THE SWIPE-->
	<!-- lisenced by MIT or GPL Version 2 licenses.-->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="./js/jquery.touchSwipe.js"></script>
	<script src="./js/jquery.touchSwipe.min.js"></script>
	<script>
		$(function()
			{	
				//This fn below is a spinner - reference: http://jsfiddle.net/gK9wH/9/
				$(window).load(function(){
    				$('#loader').fadeOut("fast");    
				});
				jQuery.noConflict();		
				//Enable swiping...
				$("#graph").swipe( {
					swipeLeft:function(event, direction, distance, duration, fingerCount) {
						var politicos = document.getElementById("politicalPeeps");
						var countries = document.getElementById("countries");
						var publications = document.getElementById("publications");
						if ((countries.style.display == "none") && (publications.style.display == "none") ) { //peeps showing
							$("#politicalPeeps").fadeOut("slow");
							$("#countries").fadeIn();
							document.getElementById("leftCircle").className = "inactiveCircle";
							document.getElementById("middleCircle").className = "activeCircle";
						} else if ((politicos.style.display == "none") && (publications.style.display == "none") ) { //countries showing
							$("#countries").fadeOut("slow");
							$("#publications").fadeIn();
							document.getElementById("middleCircle").className = "inactiveCircle";
							document.getElementById("rightCircle").className = "activeCircle";
						};
					},
					swipeRight:function(event, direction, distance, duration, fingerCount) {
						var politicos = document.getElementById("politicalPeeps");
						var countries = document.getElementById("countries");
						var publications = document.getElementById("publications");
						if ((countries.style.display == "none") && (politicos.style.display == "none") ) {
							$("#publications").fadeOut("slow");
							$("#countries").fadeIn();
							document.getElementById("rightCircle").className = "inactiveCircle";
							document.getElementById("middleCircle").className = "activeCircle";
						} else if ((politicos.style.display == "none") && (publications.style.display == "none") ) {
							$("#countries").fadeOut("slow");
							$("#politicalPeeps").fadeIn();
							document.getElementById("middleCircle").className = "inactiveCircle";
							document.getElementById("leftCircle").className = "activeCircle";
						};
					},
					//Default is 75px, set to 0 for demo so any distance triggers swipe
					threshold:75
				});
			});
	</script>
	<!-- END STUFF FOR THE SWIPE-->

<!-- STUFF FOR THE GRAPH OUTPUT OF SOMEONE'S POLITICAL STANCE-->
				<script src="http://d3js.org/d3.v3.min.js"></script>
				<script>
				 //can put in multiple types of data, just get x,y at same data index
				var xdata = [<?php echo $user->fiscal_scale; ?>], //User data inout from db
					ydata = [<?php echo $user->social_scale; ?>],
					name = ["you"];
					dataset = [[41,34, "Obama"],[78, 91, "Reagan"], [13, 87, "Fidel Castro"], [7,12, "Ghandi"], [71,23,"A. Huffington"]];
					//toggle data sets - countries, publications, US regions, celebs???
					datasetCountries = [[39,34, "UK"],[7, 12, "Sweden"], [22, 85, "China"], [52,55, "Chile"], [86,94,"Sudan"]];
					datasetPublications = [[87,91, "Fox"],[18, 7, "Rolling Stone"], [47, 43, "Economist"], [67,62, "WSJ"], [44,33,"NY Times"]];


				/*TO DRAG YOUR STUFF*/
				//http://jsfiddle.net/ZrCQE/2/
				var dragCircle = d3.behavior.drag()
			    .on('dragstart', function() {
			        d3.event.sourceEvent.stopPropagation();
			        console.log('Start Dragging Circle');
			    })
			    .on('drag', function(d, i) {
			        d.cx += d3.event.dx;
			        d.cy += d3.event.dy;
			        d3.select(this).attr("cx", d.cx).attr("cy", d.cy)
			    });


				var margin = {top: 25, right: 5, bottom: 25, left: 20},
				    width = 270 - margin.left - margin.right,
				    height = 270 - margin.top - margin.bottom;

				var x0 = Math.max(0, 100);
				var y0 = Math.max(0, 100);

				var x = d3.scale.linear()
				    .domain([0, x0])
				    .range([0, width])
				    .nice();

				var y = d3.scale.linear()
				    .domain([0, y0])
				    .range([height, 0])
				    .nice();

				// set the axes
				var xAxis = d3.svg.axis()
				    .scale(x)
				    .orient("bottom")
				    .tickValues([]);

				var yAxis = d3.svg.axis()
				    .scale(y)
				    .tickValues([])
				    .orient("left");

				var chart = d3.select(document.getElementById("graph"))
					.append('svg:svg')
					.attr('width', width + margin.right + margin.left)
					.attr('height', height + margin.top + margin.bottom)
					.attr('class', 'chart');

				var main = chart.append('g')
					.attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
					.attr('width', width)
					.attr('height', height)
					.attr('class', 'main')  



				//=====  draw the axes  ====
				main.append('g')
					.attr('transform', 'translate(0,' + height/2 + ')')
					.attr('class', 'main axis')
					.call(xAxis);


				main.append('g')
					.attr('transform', 'translate(' + width/2 + ',0)')
					.attr('class', 'main axis')
					.call(yAxis);

				d3.selection.prototype.moveToFront = function() { 
				  return this.each(function() { 
				    this.parentNode.appendChild(this); 
				  }); 
				};

				
				// ======  add YOUR DOT!  =======
				main.append("svg:circle")
				    .attr("class", "dot")
				    .attr("cy", function (d,i) { return y(ydata[i]); } ) 
				    .attr("cx", function (d,i) { return x(xdata[i]); } ) 
				    .attr("r", 10) //size of the dot//another axis label 
				    .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    				})
    				//.call(dragCircle);  
				   
				 
				main.append("text")
				   .text("you") 
				   .attr("y", function (d,i) { return y(ydata[i]+ 3.5); } )
				   .attr("x", function (d,i) { return x(xdata[i]+ 3.5); } )
				   .attr("font-size", "11px")
				   .attr("fill", "gray")
				   .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});

				//==== end of your dot stuff ====


				//=======draw the background colors==========
				var g = main.append("svg:g");
				g.selectAll("scatter-dots")
				      .data(ydata)
				      .enter().append("svg:circle")
				      	  .attr("class", "backDot")
				          .attr("cy", function (d,i) { return y(50); } )
				          .attr("cx", function (d,i) { return x(50); } )
				          .attr("r", 40); //size of the dots
				g.selectAll("scatter-dots")
				      .data(ydata)
				      .enter().append("svg:circle")
				      	  .attr("class", "backDot")
				          .attr("cy", function (d,i) { return y(50); } )
				          .attr("cx", function (d,i) { return x(50); } )
				          .attr("r", 80); 
				g.selectAll("scatter-dots")
				      .data(ydata)
				      .enter().append("svg:circle")
				      	  .attr("class", "backDot")
				          .attr("cy", function (d,i) { return y(50); } )
				          .attr("cx", function (d,i) { return x(50); } )
				          .attr("r", 120); 
				g.selectAll("scatter-dots")
				      .data(ydata)
				      .enter().append("svg:circle")
				      	  .attr("class", "backDot")
				          .attr("cy", function (d,i) { return y(50); } )
				          .attr("cx", function (d,i) { return x(50); } )
				          .attr("r", 160); 
				//======= end background circles ==========



				//============ Comparison peeps ===========
				//-----------POLITICAL PEEPS
				//Add the comparison dots for other peeps
				var gPolitics = main.append("svg:g")
							.attr("id", "politicalPeeps");
				gPolitics.selectAll("circle")
					   .data(dataset)
					   .enter()
					   .append("circle")
				       .attr("class", "dotOther")
				       .attr("cy", function (d,i) { return y(dataset[i][1]); } )
				       .attr("cx", function (d,i) { return x(dataset[i][0]); } )
				       .attr("r", 6) //size of the dots
				       .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});
				
				//labels for all comparison data points
				gPolitics.selectAll("text")
				   .data(dataset)
				   .enter()
				   .append("text")
				   .text(function (d,i) { return dataset[i][2]}) //The label
				   .attr("y", function (d,i) { return y(dataset[i][1] + 3); } )
				   .attr("x", function (d,i) { return x(dataset[i][0]+ 3); } )
				   .attr("font-size", "11px")
				   .attr("fill", "gray")
				   .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});

				//-----------COUNTRIES
				//Add the comparison dots for other peeps
				var gCountries = main.append("svg:g")
							.attr("id", "countries")
							.style("display", "none");

				gCountries.selectAll("circle")
					   .data(datasetCountries)
					   .enter()
					   .append("circle")
				       .attr("class", "dotOther")
				       .attr("cy", function (d,i) { return y(datasetCountries[i][1]); } )
				       .attr("cx", function (d,i) { return x(datasetCountries[i][0]); } )
				       .attr("r", 6) //size of the dots
				       .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});
				
				//labels for all comparison data points
				gCountries.selectAll("text")
				   .data(datasetCountries)
				   .enter()
				   .append("text")
				   .text(function (d,i) { return datasetCountries[i][2]}) //The label
				   .attr("y", function (d,i) { return y(datasetCountries[i][1] + 3); } )
				   .attr("x", function (d,i) { return x(datasetCountries[i][0]+ 3); } )
				   .attr("font-size", "11px")
				   .attr("fill", "gray")
				   .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});
				

				//-----------Publications
				//Add the comparison dots for other peeps
				var gPubs = main.append("svg:g")
							.attr("id", "publications")
							.style("display", "none");

				gPubs.selectAll("circle")
					   .data(datasetPublications)
					   .enter()
					   .append("circle")
				       .attr("class", "dotOther")
				       .attr("cy", function (d,i) { return y(datasetPublications[i][1]); } )
				       .attr("cx", function (d,i) { return x(datasetPublications[i][0]); } )
				       .attr("r", 6) //size of the dots
				       .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});
				
				//labels for all comparison data points
				gPubs.selectAll("text")
				   .data(datasetPublications)
				   .enter()
				   .append("text")
				   .text(function (d,i) { return datasetPublications[i][2]}) //The label
				   .attr("y", function (d,i) { return y(datasetPublications[i][1] + 3); } )
				   .attr("x", function (d,i) { return x(datasetPublications[i][0]+ 3); } )
				   .attr("font-size", "11px")
				   .attr("fill", "gray")
				   .on("click", function() {
      						var sel = d3.select(this);
     						 sel.moveToFront();
    					});


				//============ END Comparison peeps ===========





				// ============  AXES LABELS  ================
				//1st half of fiscal liberal  
				main.append('g')
				   .append("text")
				   .text("Fiscal") 
				   .attr("y", function (d) { return y(52); } )
				   .attr("x", function (d) { return x(-8); } )
				   .attr("class", "typeLabel");

				//2nd half of fiscal liberal
				main.append('g')
				   .append("text")
				   .text("Liberal") 
				   .attr("y", function (d) { return y(45); } )
				   .attr("x", function (d) { return x(-8); } )
				   .attr("class", "typeLabel");

				//1st half of fiscal conservative  
				main.append('g')
				   .append("text")
				   .text("Fiscal") 
				   //.attr("transform", "rotate(-90)")
				   .attr("y", function (d) { return y(52); } )
				   .attr("x", function (d) { return x(88); } )
				   .attr("class", "typeLabel") ;

				 //2nd half of fiscal conservative  
				main.append('g')
				   .append("text")
				   .text("Conserv") 
				   //.attr("transform", "rotate(-90)")
				   .attr("y", function (d) { return y(45); } )
				   .attr("x", function (d) { return x(83); } )
				   .attr("class", "typeLabel") ;

				//another axis label   
				main.append('g')
				   .append("text")
				   .text("Social Liberal") 
				   .attr("y", function (d) { return y(-10); } )
				   .attr("x", function (d) { return x(34); } )
				   .attr("class", "typeLabel");

				//another axis label   
				main.append('g')
				   .append("text")
				   .text("Social Conservative") 
				   .attr("y", function (d) { return y(105); } )
				   .attr("x", function (d) { return x(28); } )
				   .attr("class", "typeLabel");


				</script>
<!-- End of graph javascript-->

		
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



	</body>
</html>