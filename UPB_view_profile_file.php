<?php

	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts
	$pageURL = get_permalink();
	$sign = strpos($pageURL,'?')?'&':'?';
	global $wpdb;
	$upb_fields =$wpdb->prefix."upb_fields";
	function checkfieldname($fieldname,$value)
	{
		global $wpdb;
		$upb_option=$wpdb->prefix."upb_option";
		$select="select value from $upb_option where fieldname='".$fieldname."'";
		$data = $wpdb->get_var($select);
		//$data=mysql_query($select);
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
	if($login1)
	{
		include 'UPB_register_file.php';
	}
	else if($login2)
	{
		include 'UPB_login_file.php';
	}
	else if($login3)
	{
		include 'UPB_recover_password_file.php';
	}
	else if($login5)
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
                function toggleDivFun1(a)
                {
                     $(a).parent('.toggleDiv1').hide();
                     $(a).parent('.toggleDiv1').parent('.toggleDiv').children('.toggleDiv2').show();
                }
                function toggleDivFun2(a)
                {
                     $(a).parent('.toggleDiv2').hide();
                     $(a).parent('.toggleDiv2').parent('.toggleDiv').children('.toggleDiv1').show();
                }
            </script>
<?php
			$current_user = wp_get_current_user();
			$current_id = $current_user->ID;
			$avtar_image = get_user_meta( $current_id, 'avtar_image' );
			$user_info = get_userdata($current_id);
			$user_description = $user_info->user_description;
?>
<div id="upb-form">
<div class="top-part">
                    <div class="profile-user-name"><?php the_author_meta('first_name',$current_id); ?>&nbsp;<?php the_author_meta('last_name',$current_id); ?></div>
                    <div class="profile-user-button">
                        <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login5=1" title="Edit Profile">
                            <div class="UltimatePB-Button">
                                Edit
                            </div>
                        </a>



                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">



                            <div class="UltimatePB-Button">



                                Logout



                            </div>



                        </a>



                    </div>



                </div>

            <div id="main-upb-form"> 



                



                <div class="main-edit-profile" >



	                <div class="left-img-part">



<?php



						if($avtar_image[0])
						{
							echo '<div class="profile-img-device"><img src="' . $avtar_image[0] . '"/></div>';		
						}
						else
						{
?>

 <div class="profile-img-device"><img src="<?php echo $path . 'images/default.jpg'; ?>" /></div>

<?php
						}
?>
                    </div>



                    <div class="right-profile-info">



                             	<?php if (checkfieldname("upb_nicknameshowhide","yes")==true && (get_user_meta($current_id,'nickname', true) !="")) : ?>



                <div class="user-name-info">Nick Name: <?php the_author_meta('nickname',$current_id); ?></div>



                <?php endif; ?>



                <?php if (checkfieldname("upb_usernameshowhide","yes")==true ) : ?>



                <div class="user-name-info">User Name: <?php the_author_meta('user_login',$current_id); ?></div>



                <?php endif; ?>



                <?php if (checkfieldname("upb_emailshowhide","yes")==true) : ?>



                <div class="user-email-info">Email: <?php the_author_meta('user_email',$current_id); ?></div>



                <?php endif; ?>

                <?php if (checkfieldname("upb_websiteshowhide","yes")==true) : ?>



                <div class="user-web-info"> Website: <?php the_author_meta('user_url',$current_id); ?></div>



                <?php endif; ?>

                <br>



                <?php if (checkfieldname("upb_aimshowhide","yes")==true && (get_user_meta($current_id,'aim', true) !="")) : ?>



                <div class="user-aim-info">  AIM: <?php the_author_meta('aim',$current_id); ?></div>



                <?php endif; ?>



                <?php if (checkfieldname("upb_yahooimshowhide","yes")==true && (get_user_meta($current_id,'yim', true) !="")) : ?>



                <div class="user-yahoo-info">Yahoo: <?php the_author_meta('yim',$current_id); ?></div>



                <?php endif; ?>



                <?php if (checkfieldname("upb_jabbergoogletalkshowhide","yes")==true && (get_user_meta($current_id,'jabber', true) !="")) : ?>



                <div class="user-gtalk-info">Gtalk: <?php the_author_meta('jabber',$current_id); ?></div>



                <?php endif; ?>

                <br>

                    </div>

                    

                    <div class="custom_fields">


                         <?php $qry1 = "select * from $upb_fields order by ordering asc";

							 //$reg1=mysql_query($qry1);
							 $reg1 = $wpdb->get_results($qry1);
							 //$count = mysql_num_rows($reg1);

							 if(!empty($reg1))
							 {
							 foreach($reg1 as $row1)
							 {
								 if($row1->Type!='textarea')
								 {
								// $key = "CustomField".$row1['Id'];
								 $key = str_replace(" ","_",$row1->Name);
								 $value = get_user_meta($current_id, $key, true);
								 
								 if($value!=""):
								?>

								<div class="user-custom_field">
								<?php echo '<div class="field_label">'. $row1->Name.':</div>';?>
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



                    	<div style="font-size:25px;">



                        	About Me:



						</div>



                        <div class="toggleDiv" >



                        <div class="toggleDiv1">



<?php



							$user_description_half = substr($user_description, 0, 200);
							echo $user_description_half."...";
							if(strlen($user_description) > 200)
							{
?>
                                <a onclick="toggleDivFun1(this)" href="javascript:void(0);" style="text-decoration:none;">
	                             <img src="<?php echo $path . 'images/read-more.png'; ?>" width="18" height="18" border="0">
                                </a>
<?php
							}
							
?>						</div>



						<div class="toggleDiv2" style="display:none;">



<?php



							echo $user_description;



?>



                            <a onclick="toggleDivFun2(this)" href="javascript:void(0);" style="text-decoration:none;">



                         <img src="<?php echo $path . 'images/read-less.png'; ?>" width="18" height="18" border="0">



                            </a>



                        </div>







						



                        </div>



                        



                    </div>



                    <?php endif; ?>



                    <?php

					$qry2 = "select * from $upb_fields order by ordering asc";
					$reg2 = $wpdb->get_results($qry2);

							/* $reg2=mysql_query($qry2);

							 $count = mysql_num_rows($reg2);*/

							 if(!empty($reg2))
							 {

							 foreach($reg2 as $row2)
							 {



								 if($row2->Type=='textarea')
								 {
								 //$key = "CustomField".$row2['Id'];

								 $key = str_replace(" ","_",$row2->Name);

								 $value = get_user_meta($current_id, $key, true);
								 if($value!=""):
								 ?>



                                 <div class="profile-about-me">



                    	<div style="font-size:25px;">



                        	<?php echo $row2->Name; ?>:



						</div>



                        <div class="toggleDiv" >



                        <div class="toggleDiv1" >



<?php



							$Valuehalf = substr($value, 0, 200);



							echo $Valuehalf."...";



							if(strlen($value) > 200)
							{



?>



                                <a onclick="toggleDivFun1(this)" href="javascript:void(0);" style="text-decoration:none;">



	                            <img src="<?php echo $path . 'images/read-more.png'; ?>" width="18" height="18">



                                </a>



<?php



							}



?>



                        </div>



                        <div class="toggleDiv2" style="display:none;">



<?php



							echo $value;



?>



                            <a onclick="toggleDivFun2(this)" href="javascript:void(0);" style="text-decoration:none;">



                               <img src="<?php echo $path . 'images/read-less.png'; ?>" width="18" height="18">



                            </a>



                        </div>



                        </div>



                    </div>



                                 



                                 <?php



								 endif;



								 }



							 }

							 }


					?>
                    
                </div>



	            <div class="my-post">



<?php



					$user_post_count = count_user_posts( $current_id );



					if($user_post_count)
					{



?>



                        <h3>My Posts</h3>



<?php



					}



?>



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



	                        </a>



	                        <br />



<?php



						endwhile;



?>



                    </p>



                </div>



            </div>

</div>

<?php



		}



		else



		{



?>

<div id="upb-form">

            <div id="main-upb-form" align="center">



                You need to login to view this page.



                <br />



                <br />



                <div align="center" class="log-need UPB-margin-left3">



                    <div class="UltimatePB-Button">



                        <a href="<?php echo site_url(); ?>">



                            Go back to Home-Page



                        </a>



                    </div>



       



                    <div class="UltimatePB-Button">



                        <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Login">



                            Go back to Login



                        </a>



                    </div>



                </div>



            </div>

</div>

<?php



		}



	}



?>