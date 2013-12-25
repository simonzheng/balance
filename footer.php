<!-- This div is a hack to give space between the content and the footer :(-->
<div class="container footerBuffer"></div>

<!-- Footer start-->
<div class=" navbar-fixed-bottom ">
  <div class="navbar">
    <div class="navbar-inner">
          <span class="footLogo" id="balance"><img src="img/logofooter.png" class="logo"></span>

      <!-- Alter footer options if viewing a story-->
      <?php if ($story ==false) {  //the footer for everything but in a story
        echo '<ul class="nav footer">
        <li><a href="#"><!--<i class="icon-share icon-white">--></i></a></li>
        <li class="thumbsUp"><div id="like" style="visibility:hidden;"><img src="img/icons/thumbs-up-light.png" />
        </div>
        </li>
        <li id="balance2"><img src="img/logofooter.png" class="hiddenLogo"></li>
        <li class="thumbsDown">
        <div id="dislike" style="visibility:hidden;"><img src="img/icons/thumbs-down-light.png" />
        </div>
        </li>
        <li><a href="#"><!--<i class="icon-arrow-down icon-white">--></i></a></li>
      </ul>';

      
      } else {  //the footer for stories
        
        // --- Work out if they've already liked/disliked story ---
        //sets the styling to display or hide the colored thumbs        
        $grayLikeDisplay = "";
        $blueLikeDisplay = 'style="display:none"';
        $grayDislikeDisplay = "";
        $redDislikeDisplay = 'style="display:none"';
        
        $storiesLikedStr = getCurrUser()->stories_liked;  //get user's (dis)liked stories
        $likesArr = explode(',', $storiesLikedStr); //put all read stories into array
        foreach ($likesArr as &$id) {
            if ( (string)(abs((int)$id)) == $_GET['id']) {
              //the user liked or disliked this story
              if ((int)$id > 0) { //they liked it 
                $grayLikeDisplay = 'style="display:none"';
                $blueLikeDisplay = "";
                $grayDislikeDisplay = "";
                $redDislikeDisplay = 'style="display:none"';
              } else {
                $grayLikeDisplay = "";
                $blueLikeDisplay = 'style="display:none"';
                $grayDislikeDisplay = 'style="display:none"';
                $redDislikeDisplay = "";
              }
              break;
            }
        }

        echo '<ul class="nav footer">
        <li><a href="#"><!--<i class="icon-share icon-white">--></i></a></li>
        <li class="thumbsUp"><div id="like"><img src="img/icons/thumbs-up-light.png"'.$grayLikeDisplay.' />
                        <img src="img/icons/thumbs-up-blue.png" '.$blueLikeDisplay.'/>
        </div>
        </li>
        <li id="balance2"><img src="img/logofooter.png" class="hiddenLogo"></li>
        <li class="thumbsDown">
        <div id="dislike"><img src="img/icons/thumbs-down-light.png" '.$grayDislikeDisplay.'/>
                        <img src="img/icons/thumbs-down-red.png" '.$redDislikeDisplay.'/>
        </div>
        </li>
        <li><a href="#"><!--<i class="icon-arrow-down icon-white">--></i></a></li>
      </ul>';
      }
      //redo the icon sizes... and rethink what will be the furthest right icon (hides banner & footer maybe???)
      ?>



    </div>
  </div>
</div>

<script type="text/javascript">
  
  var like = document.getElementById("like");
  var dislike = document.getElementById("dislike");

  //toggle on the thumbs up & down and make them mutually exclusive
  $("#like").click(function() {
    if (dislike.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs down has been replaced by red
    { 
      $(dislike).find('img').toggle();
    };
      $(this).find('img').toggle();
  });
  $("#dislike").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs down has been replaced by red
    { 
      $(like).find('img').toggle();
    };
      $(this).find('img').toggle();
  });


  function constructURL (id, isDislike, redirectPage) {
    var url = "./post_like.php?id=";
    if (isDislike) {
      url = url.concat("-");
    };
    url = url.concat(id);
    url = url.concat("&page=");
    url = url.concat(redirectPage);
    return url;
  }

  var storyID = "".concat(<?php echo $_GET['id']; ?>);

  //record your score if you clicked 'balance'
  $("#balance").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "story");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "story");
    }
    else {
        window.location = "./story.php"; //redirects to another story      
    };
  });

  //This is just the same as the one above but needed because of the button structure for the footer :( sorry (Xan)
  $("#balance2").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "story");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "story");
    }
    else {
        window.location = "./story.php"; //redirects to another story      
    };
  });

  //Logic for what happens if someone clicks off to somewhere else after like/dislike
  
  $("#banner-back").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "back");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "back");
    }
    else {
        window.history.go(-1); //goes back one    
    };
  });



  $("#banner-reload").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "reload");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "reload");
    }
    else {
        document.location.reload(); //reloads as per normal for id     
    };
  });


  $("#banner-home").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "index");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "index");
    }
    else {
        window.location = "./index.php"; //goes to homepage    
    };
  });


  $("#banner-search").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "search");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "search");
    }
    else {
        window.location = "./search.php"; //goes to search    
    };
  });

  $("#banner-profile").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "profile");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "profile");
    }
    else {
        window.location = "./profile.php"; //goes to profile page    
    };
  });

  $("#banner-settings").click(function() {
    if (like.getElementsByTagName("img")[0].style.display == "none") //checks whether the grey thumbs up has been replaced by blue
    {    // if it was then img[0] (the grey one) will have display 'none' so the blue is displaying
        window.location = constructURL(storyID, false, "settings");
    } else if (dislike.getElementsByTagName("img")[0].style.display == "none") 
    {   //red thumbs down is selected
        window.location = constructURL(storyID, true, "settings");
    }
    else {
        window.location = "./settings.php"; //goes to profile page    
    };
  });

</script>


