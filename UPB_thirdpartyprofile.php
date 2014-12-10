<?php
/*Controls profile page view for guest users or other registered users*/

	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts
	$pageURL = get_permalink();
	$sign = strpos($pageURL,'?')?'&':'?';
	$current_id = $_REQUEST['id'];
	$avtar_image = get_user_meta( $current_id, 'avtar_image' );

	global $wpdb;
	$upb_fields =$wpdb->prefix."upb_fields";
	$user_info = get_userdata($current_id);
	$user_description = $user_info->user_description;

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
				return false;
			}
}	
?>
<?php include 'UPB_theme.php'; ?>
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
<!--HTML for displaying the profile-->
<div id="upb-form">
  <div class="top-part">
    <div class="profile-user-name">
      <?php the_author_meta('first_name',$current_id); ?>
      &nbsp;
      <?php the_author_meta('last_name',$current_id); ?>
    </div>
    <a href="javascript:void(0);" onclick="javascript:history.back();">
    <div class="go-button">
      <div class="UltimatePB-Button "> Go back </div>
    </div>
    </a> </div>
  <div id="main-upb-form">
    <div class="main-edit-profile" >
      <div class="left-img-part">
        <div>
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

                                        echo '<img src="'.$path.'images/'.$str.'black.jpg"/>'; 
                                    }
                                    else
                                    {?>
                                        <img src="<?php echo $avtar_image[0]; ?>" />
                                        <?php
                                    } 
									
                           } 
                           else 
                           {?>
                                <img src="<?php echo $avtar_image[0]; ?>" />
                                <?php
                           } 
                          	?>
          <?php else :?>
          <div class="default_profile_pic">
            <?php  //Displays default image when user has not uploaded an image profile
		  $user_info = get_userdata($current_id);
     	  $username = $user_info->user_login;
     	  $firstname = $user_info->first_name;
		  $lastname = $user_info->last_name;
		  
		  	if($firstname!="")
			{
				echo substr($firstname,0,1);
				echo substr($lastname,0,1);
				$thirdpartyname = $firstname;
					
			}
			else
			{
				echo substr($username,0,2);
				$thirdpartyname = $username;
			}
		  
		  
		  ?>
          </div>
          <?php endif;
		  $user_info = get_userdata($current_id);
     	  $username = $user_info->user_login;
     	  $firstname = $user_info->first_name;
		  $lastname = $user_info->last_name;
		  if($firstname!="")
			{
				$thirdpartyname = $firstname;
					
			}
			else
			{
				$thirdpartyname = $username;
			}
		  
		   ?>
        </div>
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
        <div class="user-web-info"> Website: <a href="<?php the_author_meta('user_url',$current_id); ?>">
          <?php the_author_meta('user_url',$current_id); ?>
          </a></div>
        <?php endif; ?>
        <br/>
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
        <br/>
      </div>
	  
	  <!--Custom fields start-->
      <div class="custom_fields">
        <?php $qry1 = "select * from $upb_fields";
							if ( is_user_logged_in() ) {
								$where = " where Visibility='1' || Visibility='2' ";
							}
							else
							{
								$where = " where Visibility='1'";
							}
							$orderby = " order by ordering asc";
							$qry1.=$where.$orderby;
							$reg1 = $wpdb->get_results($qry1);
							
							foreach($reg1 as $row1)
							{
								
								 if($row1->Type!='textarea')
								 {
								 	$key = str_replace(" ","_",$row1->Name);
									$value = get_user_meta($current_id, $key, true);
								 	if($value!=""):
								?>
        <div class="user-custom_field">
          <?php if($value!="")echo '<div class="field_label">'. $row1->Name.':</div>';?>
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
							 ?>
      </div>
      <?php if (checkfieldname("upb_biographicalinfoshowhide","yes")==true && $user_description!="") : ?>
      <div class="profile-about-me">
        <div style="font-size:25px;"> About <?php echo $thirdpartyname;?>: </div>
        <div class="toggleDiv" >
          <div class="toggleDiv1" >
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

					$qry2 = "select * from $upb_fields";
					if( is_user_logged_in() ) {
						$where = " where Visibility='1' || Visibility='2' ";
					}
					else
					{
						$where = " where Visibility='1'";
					
					}
					
					$orderby = " order by ordering asc";
					$qry2.=$where.$orderby;
					$reg2 = $wpdb->get_results($qry2);
					
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
            <a onclick="toggleDivFun1(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-more.png'; ?>" width="18" height="18" border="0"> </a>
            			<?php
							}
						?>
          </div>
          <div class="toggleDiv2" style="display:none;">
           			 <?php
							echo $value;
						?>
            <a onclick="toggleDivFun2(this)" href="javascript:void(0);" style="text-decoration:none;"> <img src="<?php echo $path . 'images/read-less.png'; ?>" width="18" height="18" border="0"> </a> </div>
        </div>
      </div>
      <?php
	 endif;
 	}
 }
?>
    </div>
	<!--HTML for displaying user posts-->
    <div class="my-post">
      <?php

					$user_post_count = count_user_posts( $current_id );//Fetches posts

					if($user_post_count && checkfieldname("upb_postshowhide","yes")==true)
					{

?>
      <h3><?php echo $thirdpartyname."'s"; ?> Posts</h3>
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

				
				?>
				<h3><?php echo $thirdpartyname."'s"; ?> Products</h3><p>
				<?php
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

				?>

				<h3><?php echo $thirdpartyname."'s"; ?> Listing</h3> <p>
				<?Php
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

				
				?>
				<h3><?php echo $thirdpartyname."'s"; ?> Products</h3><p>
				<?php
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

				
				?>
				<h3>Topics Started by <?php echo $thirdpartyname; ?></h3><p>
				<?php
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
