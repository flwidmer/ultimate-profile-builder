<?php 

	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts



	$pageURL = get_permalink();



	$sign = strpos($pageURL,'?')?'&':'?';



	$id = $_REQUEST['id'];



	$search = $_REQUEST['search'];







	if($id)



	{



		include 'UPB_thirdpartyprofile.php';



	}



	else



	{



?>



       <?php /*?> <link href="<?php echo $path; ?>css/style.css" rel="stylesheet" type="text/css" /><?php */?>

        <?php include 'UPB_theme.php'; ?>



		<div id="profile-page ">



<!-----------------------Start Top part-------------------------->



            <div class="top-part">



                <div class="profile-user-name">



	                Members



                </div>



				<div class="member_search">



					<form action="" id="form1" name="form1" method="post"> 



						Search members



						<input type="text" id="search" name="search" />



					</form>



                </div>



            </div>



			<div class="main-edit-profile">



<!-----------------------List Box Top Area Start-------------------------->



                <div class="profile-avatar">Avatar </div>



                <div class="listview-proflle-name">Name</div>



                <div class="about-profile ">About</div>



                <div class="post-profile">Posts</div>



<!-----------------------List Box Top Area End-------------------------->







<!-----------------------List Box Start-------------------------->



                <div class="list-view-main-box">



<?php



					global $wpdb;



					$upb_option=$wpdb->prefix."upb_option";



					$select="select * from $upb_option where fieldname='upb_profile_max_resutls'";



					$data=mysql_query($select);



					$row = mysql_fetch_array($data);



					$max_results = $row['value'];







					$i=0;



					$blogusers = get_users();



					foreach($blogusers as $val)



					{



						$i++;



					}



					$results = $i;







					if($max_results == 0)



					{



						$max_results = $results+1;



						$max = $maxRec = $max_results;



					}



					else



					{



						$max = $maxRec = $max_results;



					}







					$pageNo = 0;







					if(!empty($_GET['pageNo']))



					{



						$pageNo = $_GET['pageNo'];



					}







					if($pageNo > 0)



					{



						$start = ($pageNo * $max) - $max;



					}



					else



					{



						$start = 0;



					}







					$max = $start + $max;







					for($start; $start < $max; $start++)



					{



						$userid = $blogusers[$start]->ID;



						$user_info = get_userdata($userid);







						$user_firstname = $user_info->user_firstname;



						$user_lastname = $user_info->user_lastname;



						$user_description = $user_info->user_description;



						$publish_posts = $user_info->publish_posts;







						$avtar_image = get_user_meta( $userid, 'avtar_image' );







						if(trim(strtolower($_POST['search']))==strtolower($user_firstname) || trim($_POST['search'])=="" ||trim(strtolower($_POST['search']))==strtolower($user_lastname))



						{



?>



<!----------------------- Box 1 -------------------------->



                            <div class="list-box">



	                            <a href="<?php echo $pageURL; ?><?php echo $sign; ?>id=<?php echo $userid; ?>">



                                <div class="profile-avatar">



                                	<?php if($avtar_image[0]!=""): ?>



	                                <img src="<?php echo $avtar_image[0]; ?>" width="38" height="40" />



                                    <?php else: ?>



                                    <img src="<?php echo $path . 'images/default.jpg'; ?>" width="38" height="40" />



                                    <?php endif; ?>



                                </div>



                                <div class="listview-proflle-name">



<?php



									echo $user_firstname . " " . $user_lastname;



?>



                                </div>



                                <div class="about-profile ">



<?php



									$user_description = substr($user_description, 0, 50);



									echo $user_description."...";



?>



                                </div>



                                <div class="post-profile">



<?php



									echo count_user_posts( $userid );



?>



                                </div>



                            </a>



                        </div>



<!----------------------- /Box 1 -------------------------->



<?php



					}



				}



?>



			</div>



<!-----------------------List Box End-------------------------->



		</div>



		<style type="text/css">



			.pagination a



			{



				text-decoration: none !important;



			}



        </style>



		<div align="center" class="pagination">



<?php



			if($pageNo == 0)



			{



				$pageNo = 1;



			}



			$totalPages = ceil($results / $maxRec);



			echo "Page ".$pageNo." of ".$totalPages;



			echo "<br>";



			if($pageNo > 1)



			{



?>



                <a href="<?php echo $pageURL; ?><?php echo $sign; ?>pageNo=<?php echo $pageNo - 1; ?>" title="Previous">



                <?php echo "&laquo;&nbsp;"; ?>



                </a>



<?php



			}



			else



			{



				echo "&laquo;&nbsp;"; 



			}				



			for($i = 1; $i <= $totalPages; $i++)



			{



				if($i == $pageNo)



				{



					echo ' ' . $i . ' ';



				}



				else



				{



?>



                    <a href="<?php echo $pageURL; ?><?php echo $sign; ?>pageNo=<?php echo $i; ?>">



	                    <?php echo "&nbsp;".$i."&nbsp;"; ?>



                    </a>



<?php



				}						



			}



			if($pageNo < $totalPages)



			{



?>



                <a href="<?php echo $pageURL; ?><?php echo $sign; ?>pageNo=<?php echo $pageNo + 1; ?>" title="Next">



                    <?php echo "&nbsp;&raquo;"; ?>



                </a>



<?php



			}



			else



			{



				echo "&nbsp;&raquo;";



			}



?>



        </div>



<?php



	}



?>