<?php 

	 $path =  plugin_dir_url(__FILE__);  // define path to link and scripts



	$pageURL = get_permalink();



	$sign = strpos($pageURL,'?')?'&':'?';





	//print_r($_REQUEST);die;	

	extract($_REQUEST);







	if($login1)



	{



		include 'UPB_register_file.php';



	}



	else if($login2)



	{



		include 'UPB_login_file.php';



	}



	else if($login4)



	{



		include 'UPB_view_profile_file.php';



	}



	else if($login5)



	{



		include 'UPB_edit_profile_file.php';



	}



	else



	{



	//	$path = WP_PLUGIN_URL."/ultimate_profile_builder/";



?>



      <?php /*?>  <link type="text/css" href="<?php echo $path; ?>css/style.css" rel="stylesheet" /><?php */?>

<?php include 'UPB_theme.php'; ?>

<?php



		$user_login = $_POST['user_login'];



		if($user_login)



		{



			$lostErr= "Username or E-mail does not exist in our system";



			$lostErrC = 'lostErr';



		}



		else



		{



			$lostErrC = 'noErr';



		}



		global $wpdb;



		$wp_usermeta=$wpdb->prefix."usermeta";



		$wp_users=$wpdb->prefix."users";



		if(username_exists( $user_login ))



		{

			$userstatus = 1;

			$user_id = username_exists( $user_login );



			$user_info = get_userdata($user_id);



			$user_email = $user_info->user_email;



			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );



			wp_set_password( $random_password, $user_id );







			$subject = get_bloginfo('name');



			$subject .= " - Lost Password";



			$message = "This is your new password : " . $random_password;







			wp_mail( $user_email, $subject, $message );



?>



			<style type="text/css">



                #recoverErr



                {



                    display:none;



                    width:300px;



                }



            </style>



          <div id="upb-form">  

          

          



          <div class="main-edit-profile" align="left">



                Password has been sent to your registered email.



                <br />

           <div id="main-upb-form">  

                <div class="UPB-margin-left3">



                    <a href="<?php echo site_url(); ?>">



                        <div class="UltimatePB-Button">



                            Go back to Home-Page



                        </div>



                    </a>



                    <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Login">



                        <div class="UltimatePB-Button">



                            Go back to Login



                        </div>



                    </a>



                </div>

</div>

            </div>

            

            

            </div>



<?php



		}



		else if (email_exists( $user_login ))



		{

			$userstatus = 1;

			$user_id = email_exists( $user_login );



			$user_email = $user_login;



			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );



			wp_set_password( $random_password, $user_id );







			$subject = get_bloginfo('name');



			$subject .= " - Lost Password";



			$message = "This is your new password : " . $random_password;







			wp_mail($user_email, $subject, $message);



?>



			<div class="main-edit-profile" align="center">



				Password has been sent to your registered email.



				<br />



				<div class="margin-left">



					<a href="<?php echo site_url(); ?>">



						<div class="UltimatePB-Button">



							Go back to Home-Page



						</div>



					</a>



					<a href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Login">



						<div class="UltimatePB-Button">



							Go back to Login



						</div>



					</a>



				</div>



			</div>



<?php



		}



		else



		{

			$userstatus = 0;



?>



			<style type="text/css">



			

				.noErr{



					display:none;



					width:300px;



					margin: -20px 0 23px 223px !important;					



				}



			</style>



<?php



		}



?>



		<script language="javascript" type="text/javascript">



			function validate123()



			{



				var a = document.getElementById("user_login").value;



				if(a == "" || a == NULL)



				{



					document.getElementById('recoverErr').innerHTML='Username or E-mail is required';



					document.getElementById('recoverErr').style.display = 'block';



					document.getElementById("user_login").focus();



					return false;



				}



				else



				{



					return true;



				}



			}



		</script>

<?php if($userstatus==0) : ?>

		<div id="upb-form">



<div>Forgot Password?</div>

	<form method="post" action="" id="lostpasswordform" name="lostpasswordform" onsubmit="javascript:return validate123();">

			<div id="main-upb-form" >



			



					<div class="text-lable">

     <div class="formtable">

<div class="lable-text">

						<label for="user_login">



							Username / E-mail:



						</label></div>

<div class="input-box">

						<input type="text" size="20" value="" class="input" id="user_login" name="user_login">

      

      <div class="reg_frontErr <?php echo $lostErrC; ?>" id="recoverErr"><?php echo $lostErr; ?></div>

      </div>

      			

      </div>



						<br />



						<br />



			



						<div style="clear:both;"></div>



						<div class="login-info">Please enter your registered username or email, and we will resend your password.</div>



					</div>



				

			</div>

	<div class="UltimatePB-Button-area" align="center" >



						<input type="submit" value="Submit" class="button button-primary button-large" id="PRSubmit" name="PRSubmit">



					</div>



				</form>



		</div>

<?php endif; ?>

<?php



	}



?>