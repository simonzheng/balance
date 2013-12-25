<?php 

// DISPLAYS COMMENT POST TIME AS "1 year, 1 week ago" or "5 minutes, 7 seconds ago", etc...
//This 'time_ago' fn is open source and was found here:
//http://www.mdj.us/web-development/php-programming/another-variation-on-the-time-ago-php-function-use-mysqls-datetime-field-type/
function time_ago($date,$granularity=2) {
    $date = strtotime($date);
    $difference = time() - $date;
    $periods = array('decade' => 315360000,
        'yr' => 31536000,
        'mo' => 2628000,
        'wk' => 604800, 
        'd' => 86400,
        'hr' => 3600,
        'm' => 60,
        's' => 1);
    if ($difference < 5) { // less than 5 seconds ago, let's say "just now"
        $retval = "posted just now";
        return $retval;
    } else {                            
        foreach ($periods as $key => $value) {
            if ($difference >= $value) {
                $time = floor($difference/$value);
                $difference %= $value;
                $retval .= ($retval ? ' ' : '').$time.'';
                $retval .= /*(($time > 1) ? $key.'s' : */$key /*)*/;
                $granularity--;
            }
            if ($granularity == '0') { break; }
        }
        return $retval; //.' ago';      
    }
}



//Takes in a db row (must be a story object from the db) and returns the string of html
//that will represent that story in a list of thumbnail stories... ie. on the home page, search results, profile.
function output_story_brief($row){

        $date = time_ago($row["time"]); //this calls fn to sanitize the timestamp to 'ago' format

        //compile html output for the story in its list format
        $html_output = "";
        $html_output.= "<ul class=\"nav nav-tabs nav-stacked story\">";
        $html_output.= "<li>";
        $html_output.= "<div><a href=\"story.php?id=".$row["id"]."\">";
        $html_output.= "<img src=\"img/stories/".$row["picture"]."\" class=\"subStory\">";
        $html_output.= $row["title"];
        $html_output.= "<br/>";
        $html_output.= "<p class=\"muted small\">".$row["source"]." - ".$date."<br />";
        $html_output.= get_social_score_html_ARRAY($row)." ";
        $html_output.= get_fiscal_score_html_ARRAY($row)."  ";
        $html_output.= "<i class=\"icon-chevron-right\"></i>";
        $html_output.= "</p>";
        $html_output.= "</a></div>";
        $html_output.= "</li>";
        $html_output.= "</ul>";
    return $html_output;
}

//Takes in a db row (must be a story object from the db) and returns the string of html
//that will represent the main story on the home page - the one that comes first, with the bigger pic
function output_main_story_brief($row){

        $date = time_ago($row["time"]); //this calls fn to sanitize the timestamp to 'ago' format

        //compile html output for the main story brief format
        $html_output = "";
        $html_output .= "<div class=\"mainStory\"><div class=\"mainStory-inner story\">";
        $html_output .= "<a href=\"story.php?id=".$row["id"]."\">";
        $html_output .= "<div class=\"item\">";
        $html_output .= "<img src=\"img/stories/".$row["picture"]."\">";
        $html_output .= "<div class=\"mainStory-caption\">";
        $html_output .= "<p>".$row["title"]."</p>";
        $html_output.= "<span class=\"muted small\">".$row["source"]." - ".$date." ago <br />";
        $html_output.= get_social_score_html_ARRAY($row)." ";
        $html_output.= get_fiscal_score_html_ARRAY($row)."  ";
        $html_output.= "<i class=\"icon-chevron-right icon-white\"></i>";
        $html_output.= "</span></div></div></a></div></div>";

    return $html_output;
}




//Takes in a db row and returns the string of html for the fiscal score label
function get_fiscal_score_html($row)
{
            if ($row->fiscal_scale > 75) {
                    $fiscString = "class= 'label label-cons'"; //displays red
                    $fiscLabel = "Conservative";
                } elseif (($row->fiscal_scale >= 40) && ($row->fiscal_scale <= 60)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label'"; //displays grey
                    $fiscLabel = "Moderate";
                } elseif ($row->fiscal_scale < 25) { //this case should be fairly rare... I think
                    $fiscString = "class= 'label label-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row->fiscal_scale >= 25) && ($row->fiscal_scale < 40)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row->fiscal_scale > 60)&&($row->fiscal_scale <= 75)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-cons'"; //displays grey
                    $fiscLabel = "Conservative";
                }
        return "<span ".$fiscString."><img src='img/icons/pricetag.png' class='scoreImgPrice'>".$fiscLabel."</span>";
}

//Takes in a db row and returns the string of html for the social score label
function get_social_score_html($row)
{
            if ($row->social_scale > 75) {
                    $socString = "class= 'label label-cons'"; //displays red
                    $socLabel = "Conservative";
                } elseif (($row->social_scale >= 40) && ($row->social_scale <= 60)) { //this case should be fairly rare... I think
                    $socString = "class = 'label'"; //displays grey
                    $socLabel = "Moderate";
                } elseif ($row->social_scale < 25) { //this case should be fairly rare... I think
                    $socString = "class= 'label label-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row->social_scale >= 25) && ($row->social_scale < 40)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row->social_scale > 60)&&($row->social_scale <= 75)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-cons'"; //displays grey
                    $socLabel = "Conservative";
                }                
    return "<span ".$socString."><img src='img/icons/group.png' class='scoreImgGroup'>".$socLabel."</span>";
}

//Takes in a db row and returns the string of html for the fiscal score label
//NB: does this for objects that have to be accessed via the array notation and not -> notation
function get_social_score_html_ARRAY($row)
{
            if ($row['social_scale'] > 75) {
                    $socString = "class= 'label label-cons'"; //displays red
                    $socLabel = "Conservative";
                } elseif (($row['social_scale'] >= 40) && ($row['social_scale'] <= 60)) { //this case should be fairly rare... I think
                    $socString = "class = 'label'"; //displays grey
                    $socLabel = "Moderate";
                } elseif ($row['social_scale'] < 25) { //this case should be fairly rare... I think
                    $socString = "class= 'label label-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row['social_scale'] >= 25) && ($row['social_scale'] < 40)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row['social_scale'] > 60)&&($row['social_scale'] <= 75)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-cons'"; //displays grey
                    $socLabel = "Conservative";
                }                
    return "<span ".$socString."><img src='img/icons/group.png' class='scoreImgGroup'>".$socLabel."</span>";
}


//Takes in a db row and returns the string of html for the social score label
//NB: does this for objects that have to be accessed via the array notation and not -> notation
function get_fiscal_score_html_ARRAY($row)
{
            if ($row['fiscal_scale'] > 75) {
                    $fiscString = "class= 'label label-cons'"; //displays red
                    $fiscLabel = "Conservative";
                } elseif (($row['fiscal_scale'] >= 40) && ($row['fiscal_scale'] <= 60)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label'"; //displays grey
                    $fiscLabel = "Moderate";
                } elseif ($row['fiscal_scale'] < 25) { //this case should be fairly rare... I think
                    $fiscString = "class= 'label label-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row['fiscal_scale'] >= 25) && ($row['fiscal_scale'] < 40)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row['fiscal_scale'] > 60)&&($row['fiscal_scale'] <= 75)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-cons'"; //displays grey
                    $fiscLabel = "Conservative";
                }
        return "<span ".$fiscString."><img src='img/icons/pricetag.png' class='scoreImgPrice'>".$fiscLabel."</span>";
}


//Get the shorter Version
//------------start get shorter version-------------------
//-------------------------------------------------
//Takes in a db row and returns the string of html for the fiscal score label
function get_short_fiscal_score_html($row)
{
            if ($row->fiscal_scale > 75) {
                    $fiscString = "class= 'label label-cons'"; //displays red
                    $fiscLabel = "Con.";
                } elseif (($row->fiscal_scale >= 40) && ($row->fiscal_scale <= 60)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label'"; //displays grey
                    $fiscLabel = "Mod.";
                } elseif ($row->fiscal_scale < 25) { //this case should be fairly rare... I think
                    $fiscString = "class= 'label label-lib'"; //displays grey
                    $fiscLabel = "Lib.";
                } elseif (($row->fiscal_scale >= 25) && ($row->fiscal_scale < 40)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-lib'"; //displays grey
                    $fiscLabel = "Lib.";
                } elseif (($row->fiscal_scale > 60)&&($row->fiscal_scale <= 75)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-cons'"; //displays grey
                    $fiscLabel = "Con.";
                }
        return "<span ".$fiscString."><img src='img/icons/pricetag.png' class='scoreImgPrice'>".$fiscLabel."</span>";
}

//Takes in a db row and returns the string of html for the social score label
function get_short_social_score_html($row)
{
            if ($row->social_scale > 75) {
                    $socString = "class= 'label label-cons'"; //displays red
                    $socLabel = "Con.";
                } elseif (($row->social_scale >= 40) && ($row->social_scale <= 60)) { //this case should be fairly rare... I think
                    $socString = "class = 'label'"; //displays grey
                    $socLabel = "Mod.";
                } elseif ($row->social_scale < 25) { //this case should be fairly rare... I think
                    $socString = "class= 'label label-lib'"; //displays grey
                    $socLabel = "Lib.";
                } elseif (($row->social_scale >= 25) && ($row->social_scale < 40)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-lib'"; //displays grey
                    $socLabel = "Lib.";
                } elseif (($row->social_scale > 60)&&($row->social_scale <= 75)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-cons'"; //displays grey
                    $socLabel = "Con.";
                }                
    return "<span ".$socString."><img src='img/icons/group.png' class='scoreImgGroup'>".$socLabel."</span>";
}

//Takes in a db row and returns the string of html for the fiscal score label
//NB: does this for objects that have to be accessed via the array notation and not -> notation
function get_short_social_score_html_ARRAY($row)
{
            if ($row['social_scale'] > 75) {
                    $socString = "class= 'label label-cons'"; //displays red
                    $socLabel = "Con.";
                } elseif (($row['social_scale'] >= 40) && ($row['social_scale'] <= 60)) { //this case should be fairly rare... I think
                    $socString = "class = 'label'"; //displays grey
                    $socLabel = "Mod.";
                } elseif ($row['social_scale'] < 25) { //this case should be fairly rare... I think
                    $socString = "class= 'label label-lib'"; //displays grey
                    $socLabel = "Lib.";
                } elseif (($row['social_scale'] >= 25) && ($row['social_scale'] < 40)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-lib'"; //displays grey
                    $socLabel = "Lib.";
                } elseif (($row['social_scale'] > 60)&&($row['social_scale'] <= 75)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-cons'"; //displays grey
                    $socLabel = "Con.";
                }                
    return "<span ".$socString."><img src='img/icons/group.png' class='scoreImgGroup'>".$socLabel."</span>";
}


//Takes in a db row and returns the string of html for the social score label
//NB: does this for objects that have to be accessed via the array notation and not -> notation
function get_short_fiscal_score_html_ARRAY($row)
{
            if ($row['fiscal_scale'] > 75) {
                    $fiscString = "class= 'label label-cons'"; //displays red
                    $fiscLabel = "Con.";
                } elseif (($row['fiscal_scale'] >= 40) && ($row['fiscal_scale'] <= 60)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label'"; //displays grey
                    $fiscLabel = "Mod.";
                } elseif ($row['fiscal_scale'] < 25) { //this case should be fairly rare... I think
                    $fiscString = "class= 'label label-lib'"; //displays grey
                    $fiscLabel = "Lib.";
                } elseif (($row['fiscal_scale'] >= 25) && ($row['fiscal_scale'] < 40)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-lib'"; //displays grey
                    $fiscLabel = "Lib.";
                } elseif (($row['fiscal_scale'] > 60)&&($row['fiscal_scale'] <= 75)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-cons'"; //displays grey
                    $fiscLabel = "Con.";
                }
        return "<span ".$fiscString."><img src='img/icons/pricetag.png' class='scoreImgPrice'>".$fiscLabel."</span>";
}


//------------end get shorter version--------------
//-------------------------------------------------



//queries the current user who is logged in. Acesses this via the session info that we store
function getCurrUser()
{
    include("config.php");
    $query = sprintf("SELECT * FROM balance_users WHERE id = %d",
        mysql_real_escape_string($_SESSION['user_id'])); //constructs query
    $result = mysql_query($query);  // Perform Query
    return mysql_fetch_object($result);  //get user object
}


//given an id parameter, queries the db to get the story object that matches that id
function getCurrStory($id)
{
    include("config.php");
    $query = sprintf("SELECT * FROM balance_stories WHERE id = %d",
        mysql_real_escape_string($id)); //constructs query
    $result = mysql_query($query);  // Perform Query
    return mysql_fetch_object($result);  //get story object
}


function displayUserScore($user)
{
    $html = "<div class='profile-score-container'>";
     //$html .= "Hello <a href=\"profile.php\">".$user->username."</a> our data suggests you are:";//$html .= "Hello <a href=\"profile.php\">".$user->username."</a> our data suggests you are:";
    $html .=  "<table class='profileScores'><th>Socially:</th><th>Fiscally:</th>";
    $html .= "<tr><td>";
    $html .= get_social_score_html($user);
    $html .= "</td><td>";
    $html .= get_fiscal_score_html($user);
    $html .= "</td></tr></table></div>"; 
    return $html;         
}


function testdisplayUserScore($user)
{
    $html = "<ul class='pagerP'>";
    $html .= "<li>".get_profile_social_score_html($user)."</li>";
    $html .= "<li>".get_profile_fiscal_score_html($user)."</li>";
    $html .= "</ul>";
    return $html;
}




//Takes in a db row and returns the string of html for the fiscal score label
function get_profile_fiscal_score_html($row)
{
            if ($row->fiscal_scale > 75) {
                    $fiscString = "class= 'label label-cons'"; //displays red
                    $fiscLabel = "Conservative";
                } elseif (($row->fiscal_scale >= 40) && ($row->fiscal_scale <= 60)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label'"; //displays grey
                    $fiscLabel = "Moderate";
                } elseif ($row->fiscal_scale < 25) { //this case should be fairly rare... I think
                    $fiscString = "class= 'label label-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row->fiscal_scale >= 25) && ($row->fiscal_scale < 40)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-lib'"; //displays grey
                    $fiscLabel = "Liberal";
                } elseif (($row->fiscal_scale > 60)&&($row->fiscal_scale <= 75)) { //this case should be fairly rare... I think
                    $fiscString = "class = 'label label-mod-cons'"; //displays grey
                    $fiscLabel = "Conservative";
                }
        return "<span><span ".$fiscString.">Fiscally<br /><img src='img/icons/pricetag.png' class='scoreImgPrice'><br />".$fiscLabel."</span></span>";
}
//Takes in a db row and returns the string of html for the social score label
function get_profile_social_score_html($row)
{
            if ($row->social_scale > 75) {
                    $socString = "class= 'label label-cons'"; //displays red
                    $socLabel = "Conservative";
                } elseif (($row->social_scale >= 40) && ($row->social_scale <= 60)) { //this case should be fairly rare... I think
                    $socString = "class = 'label'"; //displays grey
                    $socLabel = "Moderate";
                } elseif ($row->social_scale < 25) { //this case should be fairly rare... I think
                    $socString = "class= 'label label-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row->social_scale >= 25) && ($row->social_scale < 40)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-lib'"; //displays grey
                    $socLabel = "Liberal";
                } elseif (($row->social_scale > 60)&&($row->social_scale <= 75)) { //this case should be fairly rare... I think
                    $socString = "class = 'label label-mod-cons'"; //displays grey
                    $socLabel = "Conservative";
                }                
    return "<span><span ".$socString.">Socially<br /><img src='img/icons/group.png' class='scoreImgGroup-profile'><br />".$socLabel."</span></span>";
}



function nav_displayUserScore($user)
{
   $html = "<div class='profile-score-containerNav'>";
    $html .= "<small>Our data suggests that these politcal spheres might suit you</small>";//$html .= "Hello <a href=\"profile.php\">".$user->username."</a> our data suggests you are:";
    $html .=  "<table class='profileScoresNav'><td>Socially:</td><td>Fiscally:</td>";
    $html .= "<tr><td>";
    $html .= get_social_score_html($user);
    $html .= "</td><td>";
    $html .= get_fiscal_score_html($user);
    $html .= "</td></tr></table></div>"; 
    return $html;       
}


//used in fn. below to ensure we never make a users score above 100
// or below 0. This would cause problems down the line... maybe.
function adjustValIfNeeded($value)
{
    if ($value > 100) {
        $value = 100;
    }
    if ($value < 0) {
        $value = 0;
    }
    return $value;
}


//for the machine learning where we adjust a users score based on like/dislike
function adjustUserScore($storyID)
{
    $normalizer = 50; //NB: this is randomly chose as the normalizer. IS THIS RIGHT???

    $disliked = false;  //if false then it means the user 'liked' the story
    //Story ID comes in as -ve if it was disliked but +ve if it was liked.
    if ($storyID < 0) {   //ie. if story was disliked
        $disliked = true;
        $storyID = abs($storyID);   //get rid of minus sign so we can get story from db
    }

    include "config.php";
    $story = getCurrStory($storyID);
    $user = getCurrUser();

        //now move the user's scores closer to or further from the article
        //Soc score
        $moveScoreBy = ($story->social_scale - $user->social_scale)/$normalizer; // get's distance to move
            //ECHOS FOR TESTING ONLY_ Leave as comments
            //echo "<br>move soc by: ".$moveScoreBy;
        if (!$disliked) {
            $newSocScore = $user->social_scale + $moveScoreBy;   //if they liked it move them closer
        } else {
            $newSocScore = $user->social_scale - $moveScoreBy;  // if they disliked, move them further from it
        }
        //make sure we stay within our spectrum range
        $newSocScore = adjustValIfNeeded($newSocScore);
            //echo "<br> New Soc score: ".$newSocScore;
        
        //fisc score
        $moveScoreBy = ($story->fiscal_scale - $user->fiscal_scale)/$normalizer; 
            //echo "<br>move fisc by: ".$moveScoreBy;
        if (!$disliked) {
            $newFiscScore = $user->fiscal_scale + $moveScoreBy;  //if they liked it move them closer
        } else {
            $newFiscScore = $user->fiscal_scale - $moveScoreBy;  // if they disliked, move them further from it
        }
        //make sure we stay within our spectrum range
        $newFiscScore = adjustValIfNeeded($newFiscScore);
            //echo "<br> New fisc score: ".$newFiscScore;

        //put new score in DB - use floats to avoid integer cut off if decimal.
        $query = sprintf("UPDATE balance_users SET fiscal_scale=%f, social_scale=%f WHERE id=%d",
            mysql_real_escape_string($newFiscScore),
            mysql_real_escape_string($newSocScore),
            mysql_real_escape_string($_SESSION['user_id'])
            );
        // Actually update db now
        $result = mysql_query($query);

            //echo "<br>".$query."<br>";
            //echo "Old soc score: ".$user->social_scale ."   old fisc score: ".$user->fiscal_scale;
            //echo "<br> New soc score: ".getCurrUser()->social_scale."   new fisc score: ".getCurrUser()->fiscal_scale;
}


?>