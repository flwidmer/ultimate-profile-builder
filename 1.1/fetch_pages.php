<script>
var view = window.location.hash;

//alert(view);

//alert(current_layout);

if(current_layout==0 || view=="#grid")

gridview();

if(current_layout==1 || view=="#list")

listview();



function gridview()

{

	

	//alert('grid');

	

	current_layout=0;

	window.location.hash = 'grid';

	jQuery("#listusers .list-box").hide("slow");

	jQuery(".listview_header").hide("slow");

	jQuery("#listusers .box-view").show("slow");

	

}

function listview()

{

	//alert('list');

	

	current_layout=1;

	window.location.hash = 'list';

	jQuery("#listusers .box-view").hide("slow");

	

	jQuery("#listusers .list-box").show("slow");

	

	jQuery(".listview_header").show("slow");

	

	

	

	

}

</script>

<?php



$role = $_REQUEST['role'];

//include 'initial.php';

//include('../../../wp-blog-header.php');



//include 'UPB_config.php';

$path =  plugin_dir_url(__FILE__);   // define path to link and scripts

//sanitize post value

$pageURL = $_REQUEST['pageurl'];

$sign = strpos($pageURL,'?')?'&':'?';	

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//$get_total_rows = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");

//echo $get_total_rows;



//$results = mysqli_query($connecDB,"SELECT COUNT(*) FROM paginate");

//$get_total_rows = mysqli_fetch_array($results); //total records



	$upb_option=$wpdb->prefix."upb_option";

$item_per_page = $wpdb->get_var("select value from $upb_option where fieldname='upb_profile_max_resutls'");

//validate page number is really numaric

if(!is_numeric($page_number)){die('Invalid page number!');}



//get current starting point of records

$position = ($page_number * $item_per_page);

//echo $position;die;

$endlimit = $position + $item_per_page;

//echo $page_number;

//die;

//Limit our results within a specified range. 

//$results = mysqli_query($connecDB,"SELECT id,name,message FROM paginate ORDER BY id ASC LIMIT $position, $item_per_page");



//output results from database

$usermeta_table=$wpdb->prefix."usermeta";

$users_table=$wpdb->prefix."users";

if(!empty($_REQUEST['search']))

{

$search = ( isset($_REQUEST['search']) ) ? sanitize_text_field($_REQUEST['search']) : false ;
			

			$args = array(

			'offset' => $position ,

				'number' => $item_per_page,

	'meta_query' => array(

		'relation' => 'OR',

		array(

			'key'     => 'first_name',

			'value'   => $search,

			'compare' => 'LIKE'

		),

		array(

			'key'     => 'last_name',

			'value'   => $search,

			'compare' => 'LIKE'

									)

								)

						 );

	$my_users = new WP_User_Query($args);	

			

}

else

{

	$my_users = new WP_User_Query( 

			array( 

				'role' => $role,

				'offset' => $position ,

				'number' => $item_per_page,

			));

			//print_r($my_users);die;

}

//echo $search;die;

$blogusers = $my_users->get_results();



$get_total_rows = $my_users->total_users;

				$query = "select value from $upb_option where fieldname='upb_profile_list_column'";

				$value = $wpdb->get_var($query);

				//$select = mysql_query($query);

				$column = $value;

	//			$column = 3;

				if($column==1)

				{

				$width = 80;

				$marginright = '5px';

				$marginleft = '5px';

				}

				if($column==2)

				{

				$width = 40;

				$marginright = '5px';

				$marginleft = '5px';

				}

				if($column==3)

				{

				$width = 25;

				$marginright = '5px';

				$marginleft = '5px';

				}

				if($column==4)

				{

				$width = 17;

				$marginright = '5px';

				$marginleft = '5px';	

				}

				

//$blogusers = get_users($args);

?>

 <?php

				if($get_total_rows!=0)

{ ?>

                <div class="listview_header" style="display:none;">

                <div class="profile-avatar">Avatar</div>

                <div class="listview-proflle-name">Name</div>

                <div class="about-profile">About</div>

                <div class="post-profile">Posts</div>

                </div>

 <?php } ?>               

                <?php

				if($get_total_rows==0)

{

	echo "Oops! No users in this group yet.";

}

				?>

<?php

$i = 1;

foreach($blogusers as $row)

{

	

	



						$userid = $row->ID;



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



                            <div class="box-view" id="userview" style="width:<?php echo $width.'%';?>; margin-right:<?php echo $marginright; ?>;margin-left:<?php echo $marginleft;?>" align="center">



                                <div class="box-view-name" id="userviewname">



                                    <a href="<?php echo $pageURL; ?><?php echo $sign; ?>id=<?php echo $userid; ?>">



                                        <?php echo $user_firstname . " " . $user_lastname; ?>



                                    </a>



                                </div>



                                <div class="box-view-img" align="center" id="userviewimg">



                                    <a href="<?php echo $pageURL; ?><?php echo $sign; ?>id=<?php echo $userid; ?>">



                                    	<?php if($avtar_image[0]!=""): ?>



                                        <img src="<?php echo $avtar_image[0]; ?>" width="137" height="145" />



                                        <?php else: ?>



                                        <img src="<?php echo $path . 'images/default.jpg'; ?>" width="137" height="145" />



                                        <?php endif; ?>



                                    </a>



                                </div>



                                <div class="profile-dec" align="center">



<?php



									$user_description = substr($user_description, 0, 50); 



									echo $user_description."...";



?>



                                </div>



                                <div class="box-view-post" id="userviewpost">



                                    Post



                                    <span class="box-view-post-num" id="userviewpostnum">



                                        <a href="<?php echo $pageURL; ?><?php echo $sign; ?>id=<?php echo $userid; ?>">



                                            <?php echo count_user_posts( $userid ); ?>



                                        </a>



                                    </span>



                                </div>



                            </div>



<!----------------------- Box 1 -------------------------->

							

							<div class="list-box" style="display:none;">



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



<?php

if($i == $column)

{

	echo '<div class="clear_seprator"></div>';	

}

$i++;



						}



					

	

}

?>

