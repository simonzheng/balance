<div class=" navbar-static-top navbar-inverse navbar-fixed-top">
  <div class="navbar">
    <div class="navbar-inner">
    	<div class="container">
          <button type="button" class="btnMenu collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <img class="menuImg" src="img/icons/menu.png">
          </button>
          
          <!-- back button and reload button this works out when each should be displayed or not--> 
            <?php if ($back != "back") {
              if ($home == '"active"') {
                $reload = "";
                $back = "'display:none;'";
              }
              else {
                $reload = "'display:none;'";
                $back = "'visibility:hidden;'";
              }
            } else {
              $back = "''";
              $reload = "'display:none;'";
            }  
            ?>
          	<a href="javascript:history.go(-1)" id="banner-back" onclick="return false" style=<?php echo $back?>><img src="img/icons/back.png" class="backBtn"></a>
            <a href="javascript:document.location.reload();" id="banner-reload" onclick="return false" style=<?php echo $reload?>><img src="img/icons/refreshDark.png" class ="navRefresh"></a>

            <span class="navbarText brand">
                <?php 
                $heading = "  Balance";
                if ($profile != '""') {
                  include("config.php");
                  $user = getCurrUser();
                  $heading = $user->username;
                }
                if ($settings != '""') {
                  $heading = "Settings";
                }
                if ($search !='""'){
                  $heading = "Search";
                }
                echo $heading;
                ?>
          	</span>

          <div class="nav-collapse collapse" style="height: 0px; ">
            <ul class="nav headerList">
                    <!-- REFRESH - we added this for our testing initially. but no longer needed -->
                    <!--<li class="">-->
                    	<!-- Page refresh icon, perhaps only have this present in news pages, e.g. not on profile-->
                      <!--<a href="javascript:document.location.reload();" id="banner-reload" onclick="return false"><img src="img/icons/refreshDark.png" class ="navIcons">reload</a>
                    </li>-->
              <li class=<?php echo $home;?>>
                <a href="./index.php" id="banner-home" onclick="return false"><img src="img/icons/homeDark.png" class ="navIcons">home</a> <!-- CHANGE THIS BACK TO MOBILE.PHP AFTER A/B/ TEST-->
              </li>
              <li class=<?php echo $search;?>>
                <a href="./search.php" id="banner-search" onclick="return false"><img src="img/icons/searchDark.png" class ="navIcons">search</a>
              </li>
              <li class=<?php echo $profile;?>>
                <a href="./profile.php" id="banner-profile" onclick="return false"><img src="img/icons/userDark.png" class ="navIcons">profile</a>
              </li>
              <li class=<?php echo $settings;?>>
                <a href="./settings.php" id="banner-settings" onclick="return false"><img src="img/icons/settingsDark.png" class ="navIcons">settings</a>
              </li>
            </ul>
          </div>

		</div>
    </div>
  </div>
</div>




