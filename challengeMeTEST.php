
<?php
//--------------------------------
//--Logic to get challenging stories ---
//--------------------------------
// Get stories that are NOT close to the users preferences
//NOTE: this logic is very similar to what's used in profile for recommended. Please mirror changes in both places



//for A/B Test
/* - find curr user's quadrant, 
  - display three other quadrants and associated stories
  - tell user what quadrant they fall into
*/

  include("config.php");
  $user = getCurrUser();
  $fiscal_scale = $user->fiscal_scale;
  $social_scale = $user->social_scale;

  //get SOC, FISC LIB quadrant
  $SFLquery = sprintf("SELECT * FROM balance_stories WHERE abs(fiscal_scale)<50 
                      AND abs(social_scale)<50 ORDER BY RAND() LIMIT 4");
  $SFLresult = mysql_query($SFLquery);

  //get SOC, FISC CONS quadrant
  $SFCquery = sprintf("SELECT * FROM balance_stories WHERE abs(fiscal_scale)>50 
                      AND abs(social_scale)>50 ORDER BY RAND() LIMIT 4");
  $SFCresult = mysql_query($SFCquery);
  
  //get SOC CONS, FISC LIB quadrant
  $SCFLquery = sprintf("SELECT * FROM balance_stories WHERE abs(fiscal_scale)<50 
                      AND abs(social_scale)>50 ORDER BY RAND() LIMIT 4");
  $SCFLresult = mysql_query($SCFLquery);
  
  //get SOC LIB, FISC CONS quadrant
  $SLFCquery = sprintf("SELECT * FROM balance_stories WHERE abs(fiscal_scale)>50 
                      AND abs(social_scale)<50 ORDER BY RAND() LIMIT 4");
  $SLFCresult = mysql_query($SLFCquery);


//Get the user's quadrant
    if (($user->fiscal_scale <= 50 && $user->social_scale <= 50)) {
      $userQuadrant = "SFL";
      $oppositeQuadrant = "SFC";
    } 
    elseif (($user->fiscal_scale >= 50 && $user->social_scale >= 50)) {
        $userQuadrant = "SFC";
        $oppositeQuadrant = "SFL";
      } 
    elseif (($user->fiscal_scale <= 50 && $user->social_scale>=50)) {
        $userQuadrant = "SCFL";
        $oppositeQuadrant = "SLFC";
      }
    elseif (($user->fiscal_scale>=50 && $user->social_scale<=50)) {
        $userQuadrant = "SLFC";
        $oppositeQuadrant = "SCFL";
      }


  function outputRest($categoryResults, $main, $numAlreadyOut)
  {
    $outputs = 0;
      while ($row = mysql_fetch_assoc($categoryResults)) { //loops through results and output list
        $outputs += 1;
        if (($outputs >1) || ($main==true)) {
          echo output_story_brief($row);
        } else {
          echo output_main_story_brief($row);  //makes 1 main story (at top) and the rest in list format
          $main = true;
        }
      }
      if (($outputs+$numAlreadyOut) == 0) { //we have nothing to recommend or they have read all recommendations
              echo "<p class='muted'>There are no current stories in this category.
                Why don't you try something new? Start balancing - read a random story by clicking <img src='img/logo.png' class='minilogo'> below. </p>";
      }
  }

  function outputHalfOpposite($result, $total) { //output half of the results for the opposite quadrant
    $outputs = 0;
    $main = false;
      while ($row = mysql_fetch_assoc($result)) { //loops through results and output list
        $outputs += 1;
        if ($outputs <= $total) {  //only output half
          if ($outputs >1) {
            echo output_story_brief($row);
          } else {
            echo output_main_story_brief($row);  //makes 1 main story (at top) and the rest in list format
            $main = true;
          }
        }
      }
    return $main;
  }

  function outputSecondHalfOpposite($result, $total) { //output half of the results for the opposite quadrant
    $outputs = 0;
    $main = false;
      while ($row = mysql_fetch_assoc($result)) { //loops through results and output list
        $outputs += 1;
        if ($outputs > $total) {  //only output 2nd half of results
          if (($outputs == ($total+1))|| ($outputs == ($total+0.5)) ){
            echo output_main_story_brief($row);   //one main story for the 1st rendered one
            $main = true;
          } else {
            echo output_story_brief($row); //output the rest in list format
          }
        }
      }
    return $main;  
  }


  //output stuff  - diff depending on what kind of user you are. The big difference is just which is your opposite corner
  // because we split up the rendering of the opposite corner into either financial or social bucket
  if ($userQuadrant=="SFL") 
  {
    $num_rows = mysql_num_rows($SFCresult); //for opposite quadrant
    echo "<legend>Socially Conservative</legend>";
    $main1 = outputHalfOpposite($SFCresult, $num_rows/2);
    outputRest($SCFLresult, $main1, $num_rows/2);

    echo "<legend>Fiscally Conservative</legend>";
    mysql_data_seek($SFCresult, 0);
    $main2 = outputSecondHalfOpposite($SFCresult, $num_rows/2);
    outputRest($SLFCresult, $main2, $num_rows/2);
    echo "<br />";
  } 
  elseif ($userQuadrant == "SFC") 
  {
    $num_rows = mysql_num_rows($SFLresult); //for opposite quadrant
    echo "<legend>Socially Liberal</legend>";
    $main1 = outputHalfOpposite($SFLresult, $num_rows/2);
    outputRest($SLFCresult, $main1, $num_rows/2);

    echo "<legend>Fiscally Liberal</legend>";
    mysql_data_seek($SFLresult, 0);
    $main2 = outputSecondHalfOpposite($SFLresult, $num_rows/2);
    outputRest($SCFLresult, $main2, $num_rows/2);
    echo "<br />";
  }
  elseif ($userQuadrant == "SCFL") 
  {
    $num_rows = mysql_num_rows($SLFCresult); //for opposite quadrant
    echo "<legend>Socially Liberal</legend>";
    $main1 = outputHalfOpposite($SLFCresult, $num_rows/2);
    outputRest($SFLresult, $main1, $num_rows/2);

    echo "<legend>Fiscally Conservative</legend>";
    mysql_data_seek($SLFCresult, 0);
    $main2 = outputSecondHalfOpposite($SLFCresult, $num_rows/2);
    outputRest($SFCresult, $main2, $num_rows/2);
    echo "<br />";
  }
  elseif ($userQuadrant == "SLFC") 
  {
    $num_rows = mysql_num_rows($SCFLresult); //for opposite quadrant
    echo "<legend>Socially Conservative</legend>";
    $main1 = outputHalfOpposite($SCFLresult, $num_rows/2);
    outputRest($SFCresult, $main1, $num_rows/2);

    echo "<legend>Fiscally Liberal</legend>";
    mysql_data_seek($SCFLresult, 0);
    $main2 = outputSecondHalfOpposite($SCFLresult, $num_rows/2);
    outputRest($SFLresult, $main2, $num_rows/2);
    echo "<br />";
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