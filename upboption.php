<?php
/*Controls General Options for the plugin in Dashboard*/
	$path =  plugin_dir_url(__FILE__); 
	include_once "upboptioncode.php";
?>
<style type="text/css">
<?php  if (checkfieldname("upb_profile_list_view", "box")==true) {
?>  #box_width {
 display:block;
}
<?php
}
else {
?>  #box_width {
 display:none;
}
<?php
}
?> .TabbedPanelsContentGroup {
float:left;
}
</style>

<div class="main">
  <div class="header"></div>
  <div class="content-wrap">
    <div class="pre-s-main">
      <div class="pre-s-top-part">
        <div class="pres-s-left-icon"> <img src="<?php echo $path; ?>images/upb-logo.jpg"/> </div>
        <div class="pres-s-heading" style="margin-top:15px;"> <a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html" ><img src="<?php echo $path; ?>images/pro-banner-ubp.jpg" /></a> </div>
      </div>
    </div>
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" id="TabbedPanelsTab1" tabindex="0">Shortcodes</li>
        <li class="TabbedPanelsTab" id="TabbedPanelsTab2" tabindex="1">Personalization</li>
        <li class="TabbedPanelsTab" id="TabbedPanelsTab3" tabindex="2">Admin Bar</li>
        <li class="TabbedPanelsTab" id="TabbedPanelsTab4" tabindex="3">Visibility</li>
        <li class="TabbedPanelsTab" id="TabbedPanelsTab5" tabindex="4">Options</li>
      </ul>
      <div class="TabbedPanelsContentGroup"> 
        
        <!--     --------------------------- Tab 1 Start------------------------------>
        
        <div class="TabbedPanelsContent">
          <div id="profile-builder" class="block ui-tabs-panel ui-widget-content ui-corner-bottom"> 
            
            <!--<h2>Ultimate Profile Builder</h2>-->
            
            <h3>Let's Start!</h3>
            <p><strong>Ultimate Profile Builder</strong> lets you create profiles and groups on your WordPress website. You can create custom fields based on user profiles and show them in registration forms. </p>
            <p> Creating specific profile/ group/ registration pages is very easy using WordPress shortcode system. Available shortcodes are given below. Just add them to your page and you are ready to go!</p>
            You can use the following shortcodes:<br>
            <div class="UPB-admin-shorts-main">
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_auth]</div>
                <div class="UPB-copy-code"><span>Copy code</span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description"> For a log-in form.</div>
              </div>
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_account]</div>
                <div class="UPB-copy-code"><span>Copy code </span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description"> For default registration form </div>
              </div>
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_account role="Subscriber"]</div>
                <div class="UPB-copy-code"><span>Copy code </span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description"> To add a registration form specific to a user role or group. You can replace "Subscriber" with any other role or group being used on your website. </div>
              </div>
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_profile]</div>
                <div class="UPB-copy-code"><span>Copy code </span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description">To grant users a front-end acces to their personal information(requires user to be logged in).</div>
              </div>
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_profile_list]</div>
                <div class="UPB-copy-code"><span>Copy code </span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description">To view a list of all users on the site.</div>
              </div>
              <div class="main-UPB-codes">
                <div class="UPB-shortcodes">[UPB_profile_list role="Subscriber"]</div>
                <div class="UPB-copy-code"><span>Copy code </span> </div>
                <div class="UPB-Preview">Preview</div>
                <div class="UPB-description">For showing user list for a specific role or a group of users. Replace "Subscriber" with group name.</div>
              </div>
            </div>
            
            <!--→ <strong>[UPB_lost_password]</strong> - to add a password recovery form.<br>--> 
            
          </div>
        </div>
        
        <!--     --------------------------- Tab 1 End------------------------------> 
        
        <!--     --------------------------- Tab 2 Start------------------------------>
        
        <div class="TabbedPanelsContent">
          <div id="profile-builder" class="block ui-tabs-panel ui-widget-content ui-corner-bottom theme_panel"> 
            
            <!--<h2>Ultimate Profile Builder</h2>-->
            <form method="post">
    		<div class="profile-top-user" style="float: left;margin-bottom: 10px;margin-top: 10px;width: 96%;font-size: 16px;padding-left: 10px;
line-height: 25px;">Custom Text for Registration Page:</div>
              <?php
			 $qry="SELECT value FROM $upb_option WHERE fieldname='Registration_Custom_Text'";
       		 $data = $wpdb->get_var($qry);
			 ?>
              <textarea id="RegCustomText" name="RegCustomText" cols="50" rows="10"><?php echo $data;?></textarea>
              <br>
              <br>
              
              <div class="profile-top-user" style="float: left;margin-bottom: 10px;margin-top: 10px;width: 96%;font-size: 16px;padding-left: 10px;
line-height: 25px;">Welcome Email Subject : <span class="pro_banner">Pro</span> <span class="pro_text_link"><a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html">GO PRO NOW!</a></span></div>
              <?php
			   $qry="SELECT value FROM $upb_option WHERE fieldname='upb_welcome_email_subject'";
			   $data = $wpdb->get_var($qry);
			   ?>
              <input type="text" name="welcomeSubject" id="welcomeSubject" value="<?php //echo $data; ?>" readonly/>
              <br>
              <br>
              <div class="profile-top-user" style="float: left;margin-bottom: 10px;margin-top: 10px;width: 96%;font-size: 16px;padding-left: 10px;
line-height: 25px;">Welcome Email Message : <span class="pro_banner">Pro</span> <span class="pro_text_link"><a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html">GO PRO NOW!</a></span></div>
              <?php
		    	$qry="SELECT value FROM $upb_option WHERE fieldname='upb_welcome_email_message'";
				$data = $wpdb->get_var($qry);
			   ?>
              <textarea id="RegWelcomeMessage" name="RegWelcomeMessage" cols="50" rows="10" readonly><?php //echo $data; ?></textarea>
              <br>
              <br>
              
              <input type="submit"  class="button-primary" value="Save" name="personalization" id="personalization" />
              </form>
              <br>
              <br> 
              <h3>Select a predefined color scheme <span class="pro_banner">Pro</span> <span class="pro_text_link"><a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html">GO PRO NOW!</a></span></h3>
            <p>Choose a predefined color scheme here. You can edit the settings of the scheme below then.</p>
            <p id="theme_loader"><img src="<?php echo $path; ?>/images/ajax-loader.gif" /></p>
            <button name="theme1" class="default" value="light" <?php if (checkfieldname("upb_theme","light")==true){ echo 'style="opacity:1"';}?> disabled>Default</button>
            <button name="theme2" class="light-green" value="lightgreen" <?php if (checkfieldname("upb_theme","lightgreen")==true){ echo 'style="opacity:1"';}?> disabled>Light Green</button>
            <button name="theme3" class="light-pink" value="lightpink" <?php if (checkfieldname("upb_theme","lightpink")==true){ echo 'style="opacity:1"';}?> disabled>Light Pink</button>
            <button name="theme4" class="light-red" value="lightred" <?php if (checkfieldname("upb_theme","lightred")==true){ echo 'style="opacity:1"';}?> disabled>Light Red</button>
            <button name="theme5" class="light-blue" value="lightblue" <?php if (checkfieldname("upb_theme","lightblue")==true){ echo 'style="opacity:1"';}?> disabled>Light Blue</button>
            <button name="theme8" class="aqua" value="aqua" <?php if (checkfieldname("upb_theme","aqua")==true){ echo 'style="opacity:1"';}?> disabled>Aqua</button>
            <button name="theme9" class="baby-blue" value="babyblue" <?php if (checkfieldname("upb_theme","babyblue")==true){ echo 'style="opacity:1"';}?> disabled>Baby Blue</button>
            <button name="theme10" class="black" value="black" <?php if (checkfieldname("upb_theme","black")==true){ echo 'style="opacity:1"';}?> disabled>Black</button>
            <button name="theme11" class="blue" value="blue" <?php if (checkfieldname("upb_theme","blue")==true){ echo 'style="opacity:1"';}?> disabled>Blue</button>
            <button name="theme12" class="blue-green" value="bluegreen" <?php if (checkfieldname("upb_theme","bluegreen")==true){ echo 'style="opacity:1"';}?> disabled>Blue Green</button>
            <button name="theme13" class="blue-violet" value="blueviolet" <?php if (checkfieldname("upb_theme","blueviolet")==true){ echo 'style="opacity:1"';}?> disabled>Blue Violet</button>
            <button name="theme14" class="brown" value="brown" <?php if (checkfieldname("upb_theme","brown")==true){ echo 'style="opacity:1"';}?> disabled>Brown</button>
            <button name="theme15" class="crimson" value="crimson" <?php if (checkfieldname("upb_theme","crimson")==true){ echo 'style="opacity:1"';}?> disabled>Crimson</button>
            <button name="theme16" class="deep-pink" value="deeppink" <?php if (checkfieldname("upb_theme","deeppink")==true){ echo 'style="opacity:1"';}?> disabled>Deep Pink</button>
            <button name="theme17" class="forest-green" value="forestgreen" <?php if (checkfieldname("upb_theme","forestgreen")==true){ echo 'style="opacity:1"';}?> disabled>forest Green</button>
            <button name="theme18" class="fuchsia" value="fuchsia" <?php if (checkfieldname("upb_theme","fuchsia")==true){ echo 'style="opacity:1"';}?> disabled>Fuchsia</button>
            <button name="theme6" class="light-mordern-green" value="lightmoderngreen" <?php if (checkfieldname("upb_theme","lightmoderngreen")==true){ echo 'style="opacity:1"';}?> disabled>Light Mordern Green</button>
            <button name="theme7" class="light-mordern-yellow" value="lightmodernyellow" <?php if (checkfieldname("upb_theme","lightmodernyellow")==true){ echo 'style="opacity:1"';}?> disabled>Light Mordern Yellow</button>
            <p></p>
            <br>
            <br>          
          </div>
        </div>
        
        <!--     --------------------------- Tab 2 End------------------------------> 
        
        <!--     --------------------------- Tab 3 Start------------------------------>
        
        <div class="TabbedPanelsContent">
          <div class="hid-show-admin-bar">
            <div class="hid-show-heading"></div>
            <form method="post" action="">
              <div class="hid-show-option">
                <div class="profile-top-user">
                  <div class="profile-user-group">Role</div>
                  <div class="profile-visibility">Toggle Visibility</div>
                </div>
                <div class="option-main">
                  <div class="user-group">Administrator </div>
                  <div class="user-group-option">
                    <input name="adminshowhide" id="adminshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_adminshowhide","yes")==true){ echo "checked";}?> />
                    <label for="adminshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Editor </div>
                  <div class="user-group-option">
                    <input name="editorshowhide" id="editorshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_editorshowhide","yes")==true){ echo "checked";}?> />
                   <label for="editorshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Author</div>
                  <div class="user-group-option">
                    <input name="authorshowhide" id="authorshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_authorshowhide","yes")==true){ echo "checked";}?> />
                   <label for="authorshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Contributor</div>
                  <div class="user-group-option">
                    <input name="contributorshowhide" id="contributorshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_contributorshowhide","yes")==true){ echo "checked";}?> />
                   <label for="contributorshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Subscriber </div>
                  <div class="user-group-option">
                    <input name="subscribershowhide" id="subscribershowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_subscribershowhide","yes")==true){ echo "checked";}?> />
                   <label for="subscribershowhide"></label>
                   </div>
                </div>
              </div>
              <br />
              <br />
              <div class="submit">
                <input type="submit" class="button-primary" value="Save" name="submit1" style="margin-top: 20px;">
              </div>
            </form>
          </div>
        </div>
        
        <!--     --------------------------- Tab 3 End------------------------------> 
        
        <!--     --------------------------- Tab 4 Start------------------------------>
        
        <div class="TabbedPanelsContent">
          <div class="hid-show-admin-bar">
            <div class="hid-show-heading"></div>
            <form method="post" action="">
              <div class="hid-show-option">
                <div class="profile-top-user">
                  <div class="profile-user-group">Profile Field</div>
                  <div class="profile-visibility">Toggle Visibility</div>
                </div>
                <div class="option-main">
                  <div class="user-group">Username </div>
                  <div class="user-group-option">
                    <input name="usernameshowhide" id="usernameshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_usernameshowhide","yes")==true){ echo "checked";}?> />
                     <label for="usernameshowhide"></label>
                     </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Nickname </div>
                  <div class="user-group-option">
                    <input name="nicknameshowhide" id="nicknameshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_nicknameshowhide","yes")==true){ echo "checked";}?> />
                   <label for="nicknameshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Email</div>
                  <div class="user-group-option">
                    <input name="emailshowhide" id="emailshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_emailshowhide","yes")==true){ echo "checked";}?> />
                    <label for="emailshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Website</div>
                  <div class="user-group-option">
                    <input name="websiteshowhide" id="websiteshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_websiteshowhide","yes")==true){ echo "checked";}?> />
                    <label for="websiteshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">AIM </div>
                  <div class="user-group-option">
                    <input name="aimshowhide" id="aimshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_aimshowhide","yes")==true){ echo "checked";}?> />
                    <label for="aimshowhide"></label>
                    </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Yahoo IM </div>
                  <div class="user-group-option">
                    <input name="yahooimshowhide" id="yahooimshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_yahooimshowhide","yes")==true){ echo "checked";}?> />
                   <label for="yahooimshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">Jabber / Google Talk </div>
                  <div class="user-group-option">
                    <input name="jabbergoogletalkshowhide" id="jabbergoogletalkshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_jabbergoogletalkshowhide","yes")==true){ echo "checked";}?> />
                    <label for="jabbergoogletalkshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">My Posts</div>
                  <div class="user-group-option">
                    <input name="postshowhide" id="postshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_postshowhide","yes")==true){ echo "checked";}?> />
                   <label for="postshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">About Me</div>
                  <div class="user-group-option">
                    <input name="aboutmeshowhide" id="aboutmeshowhide" type="checkbox" class="upb_toggle" value="yes" <?php if (checkfieldname("upb_biographicalinfoshowhide","yes")==true){ echo "checked";}?> />
                   <label for="aboutmeshowhide"></label>
                   </div>
                </div>
              </div>
              <div class="hid-show-option">
                <div class="profile-top-user">
                  <div class="profile-user-group">Third Party Plugin Integration <span class="pro_banner">Pro</span></div>
                  <div class="profile-visibility">Visibility <span class="pro_text_link"><a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html">GO PRO NOW!</a></span></div>
                </div>
                <div class="option-main">
                  <div class="user-group">Business Directory Plugin</div>
                  <div class="user-group-option">
                    <input name="directoryshowhide" id="directoryshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                   <label for="directoryshowhide"></label>
                   </div>
                </div>
                <div class="option-main">
                  <div class="user-group">WooCommerce</div>
                  <div class="user-group-option">
                    <input name="wooproductshowhide" id="wooproductshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                  <label for="wooproductshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">WP eCommerce</div>
                  <div class="user-group-option">
                    <input name="ecoproductshowhide" id="ecoproductshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                  <label for="ecoproductshowhide"></label>
                  </div>
                </div>
                <div class="option-main">
                  <div class="user-group">bbPress</div>
                  <div class="user-group-option">
                    <input name="fourmshowhide" id="fourmshowhide" onClick="jQuery('.bbpress_option').show()" type="checkbox" class="upb_toggle" style="opacity:0" value="yes" disabled/>
                   <label for="fourmshowhide"></label>
                   </div>
                </div>
                <div class="bbpress_option" <?php echo 'style="display:none;"'; ?> >
                  <div class="option-main">
                    <div class="user-group">Topics</div>
                    <div class="user-group-option">
                      <input name="topicshowhide" id="topicshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                     <label for="topicshowhide"></label>
                     </div>
                  </div>
                  <div class="option-main">
                    <div class="user-group">Replies </div>
                    <div class="user-group-option">
                      <input name="replieshowhide" id="replieshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                    <label for="replieshowhide"></label>
                    </div>
                  </div>
                  <div class="option-main">
                    <div class="user-group">Favourites </div>
                    <div class="user-group-option">
                      <input name="favouriteshowhide" id="favouriteshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                    <label for="favouriteshowhide"></label>
                    </div>
                  </div>
                  <div class="option-main">
                    <div class="user-group">Subscriptions </div>
                    <div class="user-group-option">
                      <input name="subscriptionshowhide" id="subscriptionshowhide" type="checkbox" class="upb_toggle" value="yes" style="opacity:0" disabled/>
                    	<label for="subscriptionshowhide"></label>
                     </div>
                  </div>
                </div>
              </div>
              <br />
              <br />
              <p> Note: These settings only apply to information displayed on individual profile pages. Some of the fields may still be visible on profiles list page. </p>

              <div class="submit">
                <input type="submit" class="button-primary" value="Save" name="RegCustomSubmit" style="margin-top: 20px;">
              </div>
            </form>
          </div>
        </div>
        
        <!--     --------------------------- Tab 4 End------------------------------> 
        
        <!--     --------------------------- Tab 5 Start------------------------------>
        
        <div class="TabbedPanelsContent">
          <form method="post" action="">
            <h2>General Settings</h2>
            <font id="generalSettingFont">Auto generated Password</font>
            <select name="autogeneratedepass" class="wppb_general_settings2">
              <option value="yes" <?php if (checkfieldname("upb_autogeneratedepass","yes")==true){ echo "selected";}?> >Yes</option>
              <option value="no" <?php if (checkfieldname("upb_autogeneratedepass","no")==true){ echo "selected";}?>>No</option>
            </select>
            <br>
            <br>
            <font id="settingblackwhiteimage">Show Black & White Profile Image <span class="pro_banner">Pro</span></font>
            <select name="blackwhiteimage" class="wppb_general_settings2" disabled>
              <option value="yes">Yes</option>
              <option value="no" selected>No</option>
            </select>
            <span class="pro_text_link"><a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html">GO PRO NOW!</a></span>
            <br>
            <br>
            <?php

	global $wpdb;

	$upb_option=$wpdb->prefix."upb_option";

	$select="select * from $upb_option where fieldname='upb_profile_max_resutls'";

	$data = $wpdb->get_results($select);

	$max_results = $data[0]->value;

?>
            <font id="generalSettingFont">Maximum number of profiles on a single page: </font>
            <select name="max_results" id="max_results1" class="wppb_general_settings2" onchange="javascript:if(this.selectedIndex < 4){ document.getElementById('box_width1').selectedIndex = this.selectedIndex; }">
              <?php

							$blogusers = get_users();

							$i=1;

							foreach ($blogusers as $user)

							{

?>
              <option value="<?php echo $i; ?>" <?php if (checkfieldname("upb_profile_max_resutls", $i ) == true){ echo "selected";}?> ><?php echo $i; ?></option>
              <?php

								$i++;

							}

?>
            </select>
            <br>
            <br>
            <font id="generalSettingFont">Default Profile-List View</font>
            <select name="profilelistview" class="wppb_general_settings2" onchange="checkit(this.value)">
              <option value="table" <?php if (checkfieldname("upb_profile_list_view","table")==true){ echo "selected";}?> >List View</option>
              <option value="box" <?php if (checkfieldname("upb_profile_list_view","box")==true){ echo "selected";}?> >Box View</option>
            </select>
            <br><br>
<script language="javascript" type="text/javascript">

function checkit(val)
{
	var div_box_width = document.getElementById("div_box_width");
	if(val == "table")
	{
		div_box_width.style.display = "none";
	}
	else
	{
		div_box_width.style.display = "block";
	}
}

</script>
            <div id="div_box_width" style="display:<?php echo (checkfieldname("upb_profile_list_view","box") == true)? "block" : "none"; ?>;"> <font id="generalSettingFont">Number of columns in box view:</font>
              <select name="box_width" id="box_width1" class="wppb_general_settings2" onchange="javascript:if(this.selectedIndex < 4){ document.getElementById('max_results1').selectedIndex = this.selectedIndex; }">
                <option value="1" <?php if (checkfieldname("upb_profile_list_column","1")==true){ echo "selected";}?> >1</option>
                <option value="2" <?php if (checkfieldname("upb_profile_list_column","2")==true){ echo "selected";}?> >2</option>
                <option value="3" <?php if (checkfieldname("upb_profile_list_column","3")==true){ echo "selected";}?> >3</option>
                <option value="4" <?php if (checkfieldname("upb_profile_list_column","4")==true){ echo "selected";}?> >4</option>
              </select>
              <br>
              <br>
            </div>
            
            <div id="layoutNoticeDiv"> <font size="1" id="layoutNotice"> <b>NOTE:</b><br>
              → On single-site installations the "Email Confirmation" feature only works in the front-end.<br>
              → The "Email Confirmation" feature is active (by default) on WPMU installations.</font> </div>
            <div align="left">
              <input type="hidden" name="action" value="update">
              <p class="submit">
                <input type="submit" class="button-primary" value="Save" name="submit">
              </p>
            </div>
          </form>
        </div>
        
        <!--     --------------------------- Tab 5 End------------------------------> 
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
	document.getElementById('TabbedPanelsTab'+<?php echo $selectedTabId; ?>).click();
</script> 