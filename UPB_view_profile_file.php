<?php
/*Controls profile page view for guest users or other registered users*/
	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts
	$pageURL = get_permalink();
	$sign = strpos($pageURL,'?')?'&':'?';
	global $wpdb;
	$upb_fields =$wpdb->prefix."upb_fields";

	function checkfieldname($fieldname,$value) //Checks and hides empty fields
	{
		global $wpdb;
		$upb_option=$wpdb->prefix."upb_option";
		$select="select value from $upb_option where fieldname='".$fieldname."'";
		$data = $wpdb->get_var($select);

		if($data==$value)
		{
			return true;	
		}
		else
		{
			return	false;	
		}
	}	

	extract($_REQUEST);

	if(isset($login1))
	{
		include 'UPB_register_file.php';
	}
	else if(isset($changeavatar))
	{
		include 'UPB_edit_profile_image.php';
	}
	else if(isset($login2))
	{
		include 'UPB_login_file.php';
	}
	else if(isset($login3))
	{
		include 'UPB_recover_password_file.php';
	}
	else if(isset($login5))
	{
		include 'UPB_edit_profile_file.php';
	}
	else
	{
?>
<?php include 'UPB_theme.php'; ?>
<?php
		if ( is_user_logged_in() )
		{
?>
<script language="javascript" type="text/javascript">

                function toggleDivFun1(a) /*Creates expand toggle button for large text area field */
                {
                     jQuery(a).parent('.toggleDiv1').hide();
                     jQuery(a).parent('.toggleDiv1').parent('.toggleDiv').children('.toggleDiv2').show();
                }

                function toggleDivFun2(a)
                {
                     jQuery(a).parent('.toggleDiv2').hide();
                     jQuery(a).parent('.toggleDiv2').parent('.toggleDiv').children('.toggleDiv1').show();
                }
            </script>
<?php
			$current_user = wp_get_current_user();
			$current_id = $current_user->ID;
			$avtar_image = get_user_meta( $current_id, 'avtar_image' );
			$user_info = get_userdata($current_id);
			$user_description = $user_info->user_description;
			//total default fields
			$qry = "select count(*) from $upb_option where id in(9,10,11,14,15,16,17,18) and value = 'yes'";
			$reg = $wpdb->get_var($qry);

			//total custom field
			$current_user_role = $current_user->roles[0];
			$qry1 = "select count(*) from $upb_fields  where user_group like '%".$current_user_role."%' order by ordering asc";
			$reg1 = $wpdb->get_var($qry1);
			$totalfields = $reg + $reg1 + 1;
			$i=0;

			//get blank default fields
			if($avtar_image[0]!='') $i++;
			if(get_user_meta($current_id,'first_name', true) !="") $i++;
			if(get_user_meta($current_id,'last_name', true) !="") $i++;
			if(get_user_meta($current_id,'nickname', true) !="") $i++;
			if(get_the_author_meta( 'user_url' )!="")$i++;
			if(get_user_meta($current_id,'aim', true) !="") $i++;
			if(get_user_meta($current_id,'yim', true) !="") $i++;
			if(get_user_meta($current_id,'jabber', true) !="") $i++;
			if($user_description!="") $i++;

			//get blank custom fields
			$qry2 = "select * from $upb_fields  where user_group like '%".$current_user_role."%' order by ordering asc";
			$reg2 = $wpdb->get_results($qry2);
			if(!empty($reg2))
			{
				foreach($reg2 as $result)
				{
					 $key = str_replace(" ","_",$result->Name);
					 $value = get_user_meta($current_id, $key, true);
					 if($value!="") $i++;
				}
			}
?>
<script type="text/javascript" language="javascript">
 jQuery(function() {
	var val= <?php echo $i; ?>;
	var total = <?php echo $totalfields; ?>;
    jQuery( "#progressbar" ).progressbar({
      value: val/total*100
    });

	var value = Math.round ( val/total*100);
	var profile_text = 'Profile Completed: '+ value +'%';
	jQuery("#progressbar-upper").html(profile_text);
 });
</script>
<!--HTML for displaying the profile-->
<div id="upb-form">
  <div class="top-part">
    <div class="profile-user-name">
      <?php the_author_meta('first_name',$current_id); ?>
      &nbsp;
      <?php the_author_meta('last_name',$current_id); ?>
    </div>
    <div class="profile-user-button"> <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login5=1" title="Edit Profile">
      <div class="UltimatePB-Button"> Edit </div>
      </a> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">
      <div class="UltimatePB-Button"> Logout </div>
      </a> </div>
  </div>
  <div id="main-upb-form">
    <div class="main-edit-profile" >
      <div id="progressbar-upper"></div>
      <div id="progressbar"></div>
      <div class="left-img-part">
        <?php if(isset($avtar_image[0]) && $avtar_image[0]!='') :?>
        <?php if (checkfieldname("upb_blackwhiteimage","yes")==true)
                          {
                            $r = $avtar_image[0];
                            $dir = plugin_dir_path( __FILE__ );
                            $array = explode('/',$r);
                            $count = count($array);
                            $str = substr($array[$count-1],0,-4);
                            $extensions_array = explode('.',$array[$count-1]);
                            $extension = $extensions_array[1];
                                    if($extension=='png')
                                    {
                                    $im = imagecreatefrompng($r);
                                    }
                                    else if($extension=='gif')
                                    {
                                        $im = imagecreatefromgif($r);
                                    }
                                    else
                                    {
                                        $im = imagecreatefromjpeg($r);
                                    }
									
                                    if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
                                    {
                                        $newimage = $dir.'images/'.$str.'black.jpg';
                                        imagejpeg($im,$newimage);
										?>
                                        <div class="profile-img-device"><img src="<?php echo $path.'images/'.$str.'black.jpg';?>"/>
                                        <div class="change_profile_image" style="display:none;"><a href="<?php echo $pageURL; ?><?php echo $sign; ?>changeavatar=1" title="Change Avatar">Change Avatar</a></div>
                                        </div>
                                         <?php
                                    }
                                    else
                                    {?>
        <div class="profile-img-device"> <img src="<?php echo $avtar_image[0]; ?>" /><div class="change_profile_image" style="display:none;"><a href="<?php echo $pageURL; ?><?php echo $sign; ?>changeavatar=1" title="Change Avatar">
       Change Avatar 
      </a></div></div>
        <?php
                                    } 
                           } 
                           else 
                           {?>
        <div class="profile-img-device"><img src="<?php echo $avtar_image[0]; ?>" /><div class="change_profile_image" style="display:none;"><a href="<?php echo $pageURL; ?><?php echo $sign; ?>changeavatar=1" title="Change Avatar">
       Change Avatar 
      </a></div></div>
        <?php
                           } 
                          	?>
        <?php else :?>
        <div class="profile-img-device" style="width:211px;">
        <div class="default_profile_pic" style=" width:183px;">
            <?php  //Displays default image when user has not uploaded an image profile
		  $user_info = get_userdata($current_id); 
     	  $username = $user_info->user_login;
     	  $firstname = $user_info->first_name;
		  $lastname = $user_info->last_name;
		  
		  	if($firstname!="")
			{
				echo substr($firstname,0,1);
				echo substr($lastname,0,1);
			}
			else
			{
				echo substr($username,0,2);
			}
		  ?>
          </div>
          <div class="change_profile_image" style="display:none; float:left !important;"><a href="<?php echo $pageURL; ?><?php echo $sign; ?>changeavatar=1" title="Change Avatar">
       Change Avatar 
      </a></div>
          </div>
        <?php endif; ?>
      </div>
      
      <div class="right-profile-info">
        <?php if (checkfieldname("upb_nicknameshowhide","yes")==true && (get_user_meta($current_id,'nickname', true) !="")) : ?>
        <div class="user-name-info">Nick Name:
          <?php the_author_meta('nickname',$current_id); ?>
        </div>
        <?php endif; ?>
        <?php if (checkfieldname("upb_usernameshowhide","yes")==true ) : ?>
        <div class="user-name-info">User Name:
          <?php the_author_meta('user_login',$current_id); ?>
        </div>
        <?php endif; ?>
        <?php if (checkfieldname("upb_emailshowhide","yes")==true) : ?>
        <div class="user-email-info">Email:
          <?php the_author_meta('user_email',$current_id); ?>
        </div>
        <?php endif; ?>
        <?php if (checkfieldname("upb_websiteshowhide","yes")==true) : ?>
        <div class="user-web-info"> Website:
          <?php the_author_meta('user_url',$current_id); ?>
        </div>
        <?php endif; ?>
        <br>
        <?php if (checkfieldname("upb_aimshowhide","yes")==true && (get_user_meta($current_id,'aim', true) !="")) : ?>
        <div class="user-aim-info"> AIM:
          <?php the_author_meta('aim',$current_id); ?>
        </div>
        <?php endif; ?>
        <?php if (checkfieldname("upb_yahooimshowhide","yes")==true && (get_user_meta($current_id,'yim', true) !="")) : ?>
        <div class="user-yahoo-info">Yahoo:
          <?php the_author_meta('yim',$current_id); ?>
        </div>
        <?php endif; ?>
        <?php if (checkfieldname("upb_jabbergoogletalkshowhide","yes")==true && (get_user_meta($current_id,'jabber', true) !="")) : ?>
        <div class="user-gtalk-info">Gtalk:
          <?php the_author_meta('jabber',$current_id); ?>
        </div>
        <?php endif; ?>
        <br>
      </div>
      <!--Custom fields start-->
      <div class="custom_fields">
        <?php $qry1 = "select * from $upb_fields order by ordering asc";


							 $reg1 = $wpdb->get_results($qry1);

							 if(!empty($reg1))
							 {
							 foreach($reg1 as $row1)
							 {
								 if($row1->Type!='textarea')
								 {
								 $key = str_replace(" ","_",$row1->Name);
								 $value = get_user_meta($current_id, $key, true);
								 if($value!=""):
								?>
        <div class="user-custom_field"> <?php echo '<div class="field_label">'. $row1->Name.':</div>';?>
          <?php 
								if(is_array($value))
								{
									echo '<div class="field_value">';
									foreach($value as $val)
									{
										echo '<div class="field_mulitple_value">'.$val.'</div>';	
									}
									echo '</div>';
								}
								else
								{
									echo '<div class="field_value">'.$value.'</div>'; 
								}
								?>
        </div>
        <?php
								 endif;
								 } 
							  }
							}
							 ?>
      </div>
      <?php if($user_description!="" && checkfieldname("upb_biographicalinfoshowhide","yes")==true): ?>
      <div class="profile-about-me">
        <div style="font-size:25px;"> About Me: </div>
        <div class="toggleDiv" >
          <div class="toggleDiv1">
            <?php
							$user_description_half = substr($user_description, 0, 200);
							echo $user_description_half."...";
							if(strlen($user_description) > 200)
							{
?>
            <a onclick="toggleDivFun1(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-more.png'; ?>" width="18" height="18" border="0"> </a>
            <?php
							}
?>
          </div>
          <div class="toggleDiv2" style="display:none;">
            <?php
							echo $user_description;
?>
            <a onclick="toggleDivFun2(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-less.png'; ?>" width="18" height="18" border="0"> </a> </div>
        </div>
      </div>
      <?php endif; ?>
      <?php
					$qry2 = "select * from $upb_fields order by ordering asc";
					$reg2 = $wpdb->get_results($qry2);
							 if(!empty($reg2))
							 {
							 foreach($reg2 as $row2)
							 {
								 if($row2->Type=='textarea')
								 {
								 $key = str_replace(" ","_",$row2->Name);
								 $value = get_user_meta($current_id, $key, true);
								 if($value!=""):
								 ?>
      <div class="profile-about-me">
        <div style="font-size:25px;"> <?php echo $row2->Name; ?>: </div>
        <div class="toggleDiv" >
          <div class="toggleDiv1" >
            <?php
							$Valuehalf = substr($value, 0, 200);
							echo $Valuehalf."...";
							if(strlen($value) > 200)
							{
?>
            <a onclick="toggleDivFun1(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-more.png'; ?>" width="18" height="18"> </a>
            <?php
							}
?>
          </div>
          <div class="toggleDiv2" style="display:none;">
            <?php	echo $value; ?>
            <a onclick="toggleDivFun2(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-less.png'; ?>" width="18" height="18"> </a> </div>
        </div>
      </div>
      <?php
								 endif;
								 }
							 }
						}
					?>
    </div>
    <!--HTML for displaying user posts-->
    <div class="my-post">
      <?php
					$user_post_count = count_user_posts( $current_id ); //Fetches posts
					if($user_post_count && checkfieldname("upb_postshowhide","yes")==true)
					{
?>
      <h3>My Posts</h3>
      <p>
        <?php

						global $current_user;

						get_currentuserinfo();

						$author_query = array('posts_per_page' => '-1','author' => $current_user->ID);

						$author_posts = new WP_Query($author_query);

						while($author_posts->have_posts()) : $author_posts->the_post();

?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php

								the_title();

?>
        </a> <br/>
        <?php

						endwhile;

						echo '</p>';
					}

					//WooCommerce Products sync. Fetches products created by user

				if(checkfieldname("upb_woo_productshowhide","yes")==true)	{

				$woo_product_query = array( 'post_type' => 'product','posts_per_page' => '-1','author' => $current_id);
				$author_woo_product = new WP_Query($woo_product_query);
				if(!empty($author_woo_product))
				{
				echo '<h3>My Products</h3><p>';
				while($author_woo_product->have_posts()) : $author_woo_product->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
				}
				if(checkfieldname("upb_directoryshowhide","yes")==true)	{	
					//Buisness Directory sync. Fetches listings by user

				$listing_query = array( 'post_type' => 'wpbdp_listing','posts_per_page' => '-1','author' => $current_id);
				$author_listing = new WP_Query($listing_query);

				if(!empty($author_listing))
				{
				echo '<h3>My Listing</h3> <p>';

				while($author_listing->have_posts()) : $author_listing->the_post();

?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br/>
        <?php
				endwhile;
				echo '</p>';
				}
			}	
				
				//E-Commerce Products sync. Fetches user created products

				if(checkfieldname("upb_eco_productshowhide","yes")==true)	{

				$eco_product_query = array( 'post_type' => 'wpsc-product','posts_per_page' => '-1','author' => $current_id);
				$author_eco_product = new WP_Query($eco_product_query);

				if(!empty($author_eco_product))
				{
					echo '<h3>My Products</h3><p>';
					while($author_eco_product->have_posts()) : $author_eco_product->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
			}

			
				//BBPress sync. Fetches topics created by user
				if(checkfieldname("upb_fourmshowhide","yes")==true && checkfieldname("upb_topicshowhide","yes")==true)	{

				$topic_query = array( 'post_type' => 'topic','posts_per_page' => '-1','author' => $current_id);
				$author_topic = new WP_Query($topic_query);

				if(!empty($author_topic))
				{
					echo '<h3>Topics Started</h3><p>';
					while($author_topic->have_posts()) : $author_topic->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
			}

				//Fetches user replies from BBPress

				if(checkfieldname("upb_fourmshowhide","yes")==true && checkfieldname("upb_replieshowhide","yes")==true)	{
				$reply_query = array( 'post_type' => 'reply','posts_per_page' => '-1','author' => $current_id);
				$author_reply = new WP_Query($reply_query);

				if(!empty($author_reply))
				{
					echo '<h3>Replies Created</h3><p>';
					while($author_reply->have_posts()) : $author_reply->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
			}

				//Fetches topics marked favorite by the user in BBPress
				if(checkfieldname("upb_fourmshowhide","yes")==true && checkfieldname("upb_favouriteshowhide","yes")==true)	{
				$fav = $wpdb->prefix.'_bbp_favorites';
				$favorites = get_user_meta($current_id, $fav, true);
				$favorites_array =explode(',',$favorites);
				$fav_query = array( 'post_type' => 'topic','posts_per_page' => '-1','post__in'=>$favorites_array);
				$author_fav = new WP_Query($fav_query);
				if(!empty($author_fav))
				{
					echo '<h3>Favorites</h3><p>';
					while($author_fav->have_posts()) : $author_fav->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
			}
	
				//Fetches forums subscribed by the user in BBPress

				if(checkfieldname("upb_fourmshowhide","yes")==true && checkfieldname("upb_subscriptionshowhide","yes")==true)	{
				$subs = $wpdb->prefix.'_bbp_subscriptions';
				$subscriptions = get_user_meta($current_id, $subs, true);
				$subscriptions_array =explode(',',$subscriptions);
				$subs_query = array( 'post_type' => 'topic','posts_per_page' => '-1','post__in'=>$subscriptions_array);
				$author_subs = new WP_Query($subs_query);
				if(!empty($author_subs))
				{
					echo '<h3>Subscriptions</h3><p>';
					while($author_subs->have_posts()) : $author_subs->the_post();
?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> <br />
        <?php
				endwhile;
				echo '</p>';
				}
			}
?>
    </div>
  </div>
</div>
<?php
		}
		else
		{
?>
<div id="upb-form">
  <div id="main-upb-form" align="center"> You need to login to view this page. <br />
    <br />
    <div align="center" class="log-need UPB-margin-left3">
      <div class="UltimatePB-Button"> <a href="<?php echo site_url(); ?>"> Go back to Home-Page </a> </div>
      <div class="UltimatePB-Button"> <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Login"> Go back to Login </a> </div>
    </div>
  </div>
</div>
<?php
		}
	}
?>
<script>
jQuery(".left-img-part").hover(function(e)
{
    jQuery(".change_profile_image").animate({ marginTop: "-52px" },"slow");
}, function(e) {
    jQuery(".change_profile_image").animate({ marginTop: "1px" },"slow");
});
</script>