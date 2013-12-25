


<?php
//--------------------------------
//--Logic to get recommended stories ---
//--------------------------------
// Get stories that are close to the users preferences
//NOTE: this logic is very similar to what's used in profile. Please mirror changes in both places

  include("config.php");
  $user = getCurrUser();
  $query = sprintf("SELECT * FROM balance_stories WHERE abs(fiscal_scale - %d)<20 
                      AND abs(social_scale - %d)<20 ORDER BY RAND() LIMIT 5",
          mysql_real_escape_string($user->fiscal_scale),
          mysql_real_escape_string($user->social_scale)
          );
  $result = mysql_query($query);
  $outputs = 0;
  while ($row = mysql_fetch_assoc($result)) { //loops through results and output list
    $outputs += 1;
    if ($outputs >1) {
      echo output_story_brief($row);
    } else {
      echo output_main_story_brief($row);  //makes 1 main story (at top) and the rest in list format
    }
  }
  if ($outputs == 0) { //we have nothing to recommend or they have read all recommendations
          echo "<p class='muted'>You're up to date on all of the stories that align with your views.
            Why don't you try something new? Start balancing - read a random story by clicking <img src='img/logo.png' class='minilogo'> below. </p>";
  }
?>







<!--======================================-->
<!-- OLD HTML TEMPLATE BELOW -->
<!--======================================-->

<!-- Main story-->
<!--
<div class="mainStory">
    <div class="mainStory-inner story">
        <a href="story.php">  
        <div class="item">
             <img src="img/examples/fb.jpg" alt="" />
             <div class="mainStory-caption">
                <p>Facebook Is Failing In Europe — And It's All Russia's Fault</p>
                <p class="muted small">Business Insider, just now  
                  <span class="label label-info">95%</span>
            <a href="#"><i class="icon-chevron-right icon-white"></i></a>
          </p>
             </div>
        </div>
        </a>    
    </div>
</div> 
-->

<!-- Sub stories - listed -->
<!--
<ul class="nav nav-tabs nav-stacked story">
  <li>    
    <div><a href="story.php">   
      <img src="img/examples/syria.jpg" class="subStory"> 
      Syria government indicates accepts holiday truce: Russia
      <br>
      <p class="muted small">Reuters - 11m ago
      <span class="label label-important">67%</span>
      <i class="icon-chevron-right"></i>
      </p>
    </a></div>
  </li>
  <li>
     <div><a href="story.php">   
      <img src="img/examples/debates.jpg" class="subStory"> 
    Obama talks Trump, debates, baseball on 'Tonight'     
    <br>
      <p class="muted small">CBS news - 2h ago
      <span class="label label-info">81%</span>
      <i class="icon-chevron-right"></i>
      </p>
    </a></div>
  </li>
  <li>
     <div><a href="story.php">   
      <img src="img/examples/lance.jpg" class="subStory"> 
    Lance Armstrong likely will have Boston Marathon time vacated     
    <br>
      <p class="muted small">Boston.com - 2d ago
      <span class="label label-success">0%</span>
      <i class="icon-chevron-right"></i>
      </p>
    </a></div>
  </li>

</ul>
-->

        