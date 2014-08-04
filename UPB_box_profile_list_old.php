<?php


$path =  plugin_dir_url(__FILE__);   // define path to link and scripts

	$role = $content['role'];

	$pageURL = get_permalink();



	$sign = strpos($pageURL,'?')?'&':'?';







	$id = $_REQUEST['id'];







	if($id)



	{



		include 'UPB_thirdpartyprofile.php';



	}



	else



	{





//$get_total_rows = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");

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

}

$get_total_rows = $my_users->total_users;

//$results = mysqli_query($connecDB,"SELECT COUNT(*) FROM paginate");

//$get_total_rows = mysqli_fetch_array($results); //total records



$item_per_page = $wpdb->get_var("select value from $upb_option where fieldname='upb_profile_max_resutls'");

$profile_view = $wpdb->get_var("select value from $upb_option where fieldname='upb_profile_list_view'");

//echo $profile_view;die;

//break total records into pages

$pages = ceil($get_total_rows/$item_per_page);	

//echo $pages;

//create pagination

if($pages > 1)

{

	$pagination	= '';

	$pagination	.= '<div align="center" class="pagination"><ul class="paginate">';

	for($i = 1; $i<=$pages; $i++)

	{

		$pagination .= '<li><a href="#" class="paginate_click" id="'.$i.'-page">'.$i.'</a></li>';

	}

	$pagination .= '</ul></div>';

}



?>


<script type="text/javascript">

<?php 

if($profile_view=='box')

{

	?>

	var current_layout = '0';

	<?php

}

else

{

	?>

	var current_layout = '1';

	<?php

}

?>

  

jQuery(document).ready(function() {

	jQuery("#listusers").load("<?php echo $path;?>fetch_pages.php?search=<?php echo $_REQUEST['search'];?>&pageurl=<?php echo $pageURL;?>&role=<?php echo $role; ?>", {'page':0}, function() {jQuery("#1-page").addClass('active');});  //initial page number to load

	

	jQuery(".paginate_click").click(function (e) {

		

		

		jQuery("#listusers").prepend('<div class="loading-indication"><img src="<?php echo $path;?>/images/ajax-loader.gif" /> Loading...</div>');

		

		var clicked_id = jQuery(this).attr("id").split("-"); //ID of clicked element, split() to get page number.

		var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need 

		

		jQuery('.paginate_click').removeClass('active'); //remove any active class

		

        //post page number and load returned data into result element

        //notice (page_num-1), subtract 1 to get actual starting point

		jQuery("#listusers").load("<?php echo $path;?>fetch_pages.php?search=<?php echo $_REQUEST['search'];?>&pageurl=<?php echo $pageURL;?>&role=<?php echo $role; ?>", {'page':(page_num-1)}, function(){



		});



		jQuery(this).addClass('active'); //add active class to currently clicked element (style purpose)

		

		return false; //prevent going to herf link

	});	

});





</script>

<?php /*?><link href="<?php echo $path; ?>css/pagination.css" rel="stylesheet" type="text/css">

<link href="<?php echo $path; ?>css/style.css" rel="stylesheet" type="text/css" /><?php */?>

<?php include 'UPB_theme.php'; ?>

        <div id="upb-form">



        <!-----------------------Start Top part-------------------------->



            <div class="top-part">



                <div class="profile-user-name">



                Members



                </div>

				

                <div class="member_search">

					<div style="float:left;">

                    <form action="" id="form1" name="form1" method="post"> 



                        Search members



                        <input type="text" id="search" name="search" />



                    </form>

                    </div>

				<div class="viewselector">

                <a class="listview" onClick="listview()"></a>

                <a class="gridview" onClick="gridview()"></a>

                

                </div>

                

                </div>

				

            </div>



	        <div id="main-upb-form">

            

            <!-----------------------List Box Start-------------------------->



				<div class="box-view-main " id="listusers">







                </div>

				<?php echo $pagination; ?>

<!-----------------------List Box End-------------------------->



            </div>



			



	    </div>



<?php } ?>

