<?php

	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts
	$pageURL = get_permalink();
	$sign = strpos($pageURL,'?')?'&':'?';
	extract($_REQUEST);
	if($login1)
	{
		include 'UPB_register_file.php';
	}
	else if($login3)
	{
		include 'UPB_recover_password_file.php';
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
?>
        <?php /*?><link type="text/css" href="<?php echo $path; ?>css/style.css" rel="stylesheet" /><?php */?>

		<?php include 'UPB_theme.php'; ?>

<?php

		if ( is_user_logged_in() )
		{
?>
            <div id="upb-form">

<div id="main-upb-form">

                <div class="main-edit-profile" align="center"> You are already logged-in. <br />
                    <br />
                    <div  class="all-log-device margin-left2">
                        <a href="<?php echo site_url(); ?>">
                            <div class="UltimatePB-Button">
	                            Go back to site
                            </div>
                        </a>
                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">
                            <div class="UltimatePB-Button">
	                            Logout
                            </div>
                        </a>



                    </div>



                </div>

                

                </div>



            </div>



<?php



		}



		else



		{



?>



			<style type="text/css">



                #loginErr



                {



                    display:none;



                }



            </style>



<?php



			$submit = $_POST['submit'];



			if($submit)



			{



				$user_login = $_POST['user_login'];



				$user_pass = $_POST['user_pass'];



				$rememberme = $_POST['rememberme'];







				$creds = array();



				$creds['user_login'] = trim($user_login);



				$creds['user_password'] = trim($user_pass);



				$creds['remember'] = $rememberme;



				$user = wp_signon($creds,false);







				if ( is_wp_error($user) )



				{



					$loginErr= "The password you entered for the username is incorrect";



?>



					<style type="text/css">



                        #loginErr



                        {



                            display:block;



                            width:350px;



                        }



                    </style>



                    <div id="profile-page">



                        <script type="text/javascript">



                            function validateLogin()



                            {



                                var user_login = document.getElementById("user_login").value;



                                var user_pass = document.getElementById("user_pass").value;



    



                                if (user_login==null || user_login=="")



                                {



                                    document.getElementById('divuser_login').style.display = 'block';



                                    document.getElementById("user_login").focus();



                                    return false;



                                }



    



                                if(user_pass==null || user_pass=="")



                                {



                                    document.getElementById('divuser_pass').style.display = 'block';



                                    document.getElementById('divuser_login').style.display = 'none';



                                    document.getElementById("user_pass").focus();



                                    return false;



                                }



                                return true;



                            }



                        </script>



                        <form method="post" action="" id="loginform" name="loginform" onsubmit="javascript:return validateLogin();">



                            <div id="main-upb-form" >



                                <div class="formtable">

                            <div class="lable-text">



                                    <label for="user_login"> Username </label></div>

<div class="input-box">

                                    <input type="text" size="20" value="<?php echo $user_login; ?>" class="input" id="user_login" name="user_login" ></div>



                                </div>



                                <div class="reg_frontErr" id="divuser_login" style="display:none;margin: -16px 0 23px !important; margin-left: 223px !important;">



                                    Please enter a username.



                                </div>



                                <div style="clear:both;"></div>



                                <div class="formtable">

                            <div class="lable-text">



                                    <label for="user_pass"> Password </label></div>

                                    <div class="input-box">



                                    <input type="password" size="20" value="" class="input" id="user_pass" name="user_pass" >

<div class="reg_frontErr" id="divuser_pass" style="display:none;">



                                    Please enter a password.



                                </div>



                                <div id="loginErr" class="reg_frontErr">



                                    <?php echo $loginErr; ?></div>

                                </div></div>



                                <br />



                                

                                    <div class="formtable">

                            <div class="lable-text">

                                  



                                    



                                        <label for="rememberme">&nbsp;</label></div>

										<div class="input-box">

                                        <input type="checkbox" value="true" id="rememberme" name="rememberme"> <span class="remember-me">Remember Me</span>



                                    



                                



                                </div></div>



                                



                            </div>



                            <div align="center" class="UltimatePB-Button-area">



                                <div class="UltimatePB-Button-inp" >



                                    <input type="submit" value="Log In" class="button button-primary button-large" id="login" name="submit">



                                </div>



                                <div class="UltimatePB-forgot-pass">



                                    Forget Password?



                                    <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login3=1" title="Lost Password">



                                        Click here



                                    </a>



                                    to resend



                                </div>



                            </div>



                        </form>



                    </div>



<?php



				}



				else



				{



?>







<div id="upb-form">









                    <div class="login-success">



                        Login Success!



                    </div>



                    <div class="login-dis">



                        Please choose your destination.



                    </div>

<div id="main-upb-form">

                 <div class="main-edit-profile" align="center">



                        <div class="all-log-device margin-left2" >



                            <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login4=1" title="View Profile">



                                <div class="UltimatePB-Button">



                                    View Profile



                                </div>



                            </a>



                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">



                                <div class="UltimatePB-Button">



                                    Logout



                                </div>



                            </a>



                        </div>



                    </div>

 </div>  

</div>





<?php





				}



			}



			else



			{



?>



                <div id="profile-page">



                    <script type="text/javascript">



                        function validateLogin()



                        {



                            var user_login = document.getElementById("user_login").value;



                            var user_pass = document.getElementById("user_pass").value;



                    



                            if (user_login==null || user_login=="")



                            {



                                document.getElementById('divuser_login').style.display = 'block';



                                document.getElementById("user_login").focus();



                                return false;



                            }



                    



                            if(user_pass==null || user_pass=="")



                            {



                                document.getElementById('divuser_pass').style.display = 'block';



                                document.getElementById('divuser_login').style.display = 'none';



                                document.getElementById("user_pass").focus();



                                return false;



                            }



                            return true;



                        }



                    </script>



                    <form method="post" action="" id="loginform" name="loginform" onsubmit="javascript:return validateLogin();">



                        <div id="main-upb-form">

						<div class="formtable">

                            <div class="lable-text">



                                <label for="user_login"> Username </label></div>

                                <div class="input-box">



                                <input type="text" size="20" value="<?php echo $user_login; ?>" class="input" id="user_login" name="user_login" >

<div class="reg_frontErr" id="divuser_login" style="display:none;">Please enter a username.</div>

                            </div>

                            

                            </div>



                       



                            <div class="formtable">

                            <div class="lable-text">



                                <label for="user_pass"> Password </label></div>

<div class="input-box">

                                <input type="password" size="20" value="" class="input" id="user_pass" name="user_pass" >

<div class="reg_frontErr" id="divuser_pass" style="display:none;">Please enter a password.</div>



                                <div id="loginErr" class="reg_frontErr">



                                    <?php echo $loginErr; ?>

									

                                </div>

                            </div></div>



                            

								<div class="formtable">

									

                                    	<div class="lable-text">



                                        <label for="rememberme">  </label>&nbsp;</div>

										<div class="input-box">

                                        <input type="checkbox" value="true" id="rememberme" name="rememberme"> <span class="remember-me">Remember Me</span></div>



                                    



                                </div>

                                



                            </div>



                            <div align="center" class="UltimatePB-Button-area">



                                <div class="UltimatePB-Button-inp">



                                    <input type="submit" value="Log In" class="button button-primary button-large" id="login" name="submit">



                                </div>



                                <div class="UltimatePB-forgot-pass"> Forget Password?<a href="<?php echo $pageURL; ?><?php echo $sign; ?>login3=1" title="Lost Password">Click here</a> to resend </div>



                            </div>



                       



                    </form>



                </div>



<?php



			}



		}



	}



?>
