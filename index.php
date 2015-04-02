<?php

	/*

		Plugin Name: Ultimate Profile Builder by CMSHelpLive
		
		Plugin URI: http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html

		Description: Supercharge your WordPress site's user pages with tons of additional features, customizations and power tools.

		Version: 2.3.2

		Author: CMSHelpLive Team

		Author URI: http://cmshelplive.com/

		License: GPL2
	*/

	ob_start();

	/*Plugin activation hook*/

	register_activation_hook ( __FILE__, 'activate_ultimate_profile_builder_plugin' );

	function activate_ultimate_profile_builder_plugin()
	{	

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		global $wpdb;

		$upb_cat=$wpdb->prefix."upb_cat";

		$upb_option=$wpdb->prefix."upb_option";

		$upb_field=$wpdb->prefix."upb_field";

		$upb_cat=$wpdb->prefix."upb_cat";

		$upb_fields =$wpdb->prefix."upb_fields";

		$upb_group =$wpdb->prefix."upb_group";

		

		/*Creates tables in database and fills default values*/

		$sqlcreate = "CREATE TABLE $upb_group

		(id int NOT NULL AUTO_INCREMENT,

			PRIMARY KEY(id),

			name varchar(255)

		)";

		dbDelta( $sqlcreate );



		$sqlcreate = "CREATE TABLE $upb_option

		(

			id int NOT NULL AUTO_INCREMENT,

			PRIMARY KEY(id),

			fieldname varchar(255),

			value longtext

		)";

		dbDelta( $sqlcreate );



		$insert="INSERT INTO $upb_option

		(

			`id`, `fieldname`, `value`

		)

		VALUES

		(1, 'upb_theme', 'light'),

		(2, 'upb_autogeneratedepass', 'no'),

		(3, 'upb_adminshowhide', 'no'),

		(4, 'upb_editorshowhide', 'no'),

		(5, 'upb_authorshowhide', 'no'),

		(6, 'upb_contributorshowhide', 'no'),

		(7, 'upb_subscribershowhide', 'no'),

		(8, 'upb_usernameshowhide', 'yes'),

		(9, 'upb_firstnameshowhide', 'yes'),

		(10, 'upb_lastnameshowhide', 'yes'),

		(11, 'upb_nicknameshowhide', 'yes'),

		(12, 'upb_displaynamepubliclyshowhide', 'yes'),

		(13, 'upb_emailshowhide', 'yes'),

		(14, 'upb_websiteshowhide', 'yes'),

		(15, 'upb_aimshowhide', 'yes'),

		(16, 'upb_yahooimshowhide', 'yes'),

		(17, 'upb_jabbergoogletalkshowhide', 'yes'),

		(18, 'upb_biographicalinfoshowhide', 'yes'),

		(19, 'upb_profile_list_view', 'table'),

		(20, 'upb_profile_list_column', '4'),

		(21, 'upb_profile_max_resutls', '1'),

		(22, 'Registration_Custom_Text', ''),

		(23, 'upb_blackwhiteimage', 'no'),

		(24, 'upb_directoryshowhide', 'no'),

		(25, 'upb_woo_productshowhide', 'no'),

		(26, 'upb_eco_productshowhide', 'no'),

		(27, 'upb_fourmshowhide', 'no'),

		(28, 'upb_topicshowhide', 'no'),

		(29, 'upb_replieshowhide', 'no'),

		(30, 'upb_favouriteshowhide', 'no'),

		(31, 'upb_subscriptionshowhide', 'no'),

		(32, 'upb_welcome_email_subject', ''),

		(33, 'upb_welcome_email_message', ''),

		(34, 'upb_postshowhide', 'no'),

		(35, 'upb_facebook_login', 'no'),

		(36, 'upb_facebook_app_id', ''),

		(37, 'upb_facebook_app_secret', ''),
		(38,'upb_recaptcha','no'),
		(39,'upb_public_key',''),
		(40,'upb_private_key','')
		";



		$wpdb->query($insert);



		$sqlcreate = "CREATE TABLE $upb_field

		(

			id int NOT NULL AUTO_INCREMENT,

			PRIMARY KEY(id),

			field_name varchar(255),

			value varchar(255)

		)";



		dbDelta( $sqlcreate );



		$upb_values=$wpdb->prefix."upb_values";



		$sqlcreate = "CREATE TABLE $upb_values

		(

			`id` int(11) NOT NULL AUTO_INCREMENT,

			`f_field` int(20) DEFAULT NULL,

			`value` varchar(255) DEFAULT NULL,

			`f_user` int(20) DEFAULT NULL,

			PRIMARY KEY (`id`),

			KEY `f_field` (`f_field`),

			KEY `f_user` (`f_user`)

		)";



		dbDelta( $sqlcreate );



	$sqlcreate = "CREATE TABLE IF NOT EXISTS $upb_fields (

  `Id` int(11) NOT NULL AUTO_INCREMENT,

  `Type` varchar(50) DEFAULT NULL,

  `Name` varchar(256) NOT NULL,

  `Value` longtext DEFAULT NULL,

  `Class` varchar(256) DEFAULT NULL,

  `Max_Length` varchar(256) DEFAULT NULL,

  `Cols` varchar(256) DEFAULT NULL,

  `Rows` varchar(256) DEFAULT NULL,

  `Option_Value` varchar(256) DEFAULT NULL,

  `Description` longtext DEFAULT NULL,

  `Require` varchar(256) DEFAULT NULL,

  `Readonly` varchar(256) DEFAULT NULL,

  `Visibility` varchar(256) DEFAULT NULL,

  `Ordering` int(11) DEFAULT NULL,

  `user_group` varchar(256) DEFAULT NULL,

  `registration` varchar(256) DEFAULT NULL,

  PRIMARY KEY (`Id`) )";



	dbDelta( $sqlcreate );



/*Creates default pages with shortcodes for quickstart*/

	$new_page_title = 'UPB Login Page';



	$new_page_slug = 'ultimate-login-page';



    $new_page_content = '[UPB_auth]';



    $page_check = get_page_by_path($new_page_slug);



    $new_page = array(



        'post_type' => 'page',



        'post_title' => $new_page_title,



		'post_name' => $new_page_slug,



        'post_content' => $new_page_content,



        'post_status' => 'publish',



        'post_author' => 1,



    );



    if(!isset($page_check->ID)){



        $new_page_id = wp_insert_post($new_page);



    }



	 

	$new_page_title1 = 'UPB Registration Page';



	$new_page_slug1= 'ultimate-registration-page';



    $new_page_content1 = '[UPB_account]';







    $page_check1 = get_page_by_path($new_page_slug1);



    $new_page1 = array(



        'post_type' => 'page',



        'post_title' => $new_page_title1,



		'post_name' => $new_page_slug1,



        'post_content' => $new_page_content1,



        'post_status' => 'publish',



        'post_author' => 1,



    );



    if(!isset($page_check1->ID)){



        $new_page_id1 = wp_insert_post($new_page1);



    }



	 



	$new_page_title2 = 'UPB Profile Page';



	$new_page_slug2 = 'ultimate-Profile-page';



    $new_page_content2 = '[UPB_profile]';







    $page_check2 = get_page_by_path($new_page_slug2);



    $new_page2 = array(



        'post_type' => 'page',



        'post_title' => $new_page_title2,



		'post_name' => $new_page_slug2,



        'post_content' => $new_page_content2,



        'post_status' => 'publish',



        'post_author' => 1,



    );



    if(!isset($page_check2->ID)){



        $new_page_id2 = wp_insert_post($new_page2);



    }



	 



	$new_page_title3 = 'UPB Member Page';



	$new_page_slug3 = 'ultimate-member-page';



    $new_page_content3 = '[UPB_profile_list]';







    $page_check3 = get_page_by_path($new_page_slug3);



    $new_page3 = array(



        'post_type' => 'page',



        'post_title' => $new_page_title3,



		'post_name' => $new_page_slug3,



        'post_content' => $new_page_content3,



        'post_status' => 'publish',



        'post_author' => 1,



    );



    if(!isset($page_check3->ID)){



        $new_page_id3 = wp_insert_post($new_page3);



    }



}

/*Hook for calling function for showing/ hiding admin bar*/

add_action('wp_head', 'UltimatePB_adminbar');

function UltimatePB_adminbar()

{



	include 'UPB_config.php';

	include 'addremoveadminbar.php';

}



/*Defines enqueue style/ script for front end*/

function theme_name_scripts() {

	wp_enqueue_style( 'style.css', plugin_dir_url(__FILE__) . 'css/style.css');

	wp_enqueue_style( 'pagination.css', plugin_dir_url(__FILE__) . 'css/pagination.css');

	wp_enqueue_style( 'chosen.css', plugin_dir_url(__FILE__) . 'chosen.css');

	wp_enqueue_style( 'upb.css', plugin_dir_url(__FILE__) . 'css/upb.css');

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jquery-ui-progressbar');

	wp_enqueue_script( 'password-strength-meter' );

	wp_enqueue_script( 'prism.js',  plugin_dir_url(__FILE__) . 'docsupport/prism.js' );

	wp_enqueue_script('jquery-ui-datepicker');

	wp_enqueue_style( 'calendar.css', plugin_dir_url(__FILE__) . 'calendar.css');

	wp_enqueue_style('jquery-style', 'http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css');

}

/*Defines enqueue style/ script for dashboard*/

function admin_theme_name_scripts() {

	wp_enqueue_style( 'style.css', plugin_dir_url(__FILE__) . 'css/style.css');

	wp_enqueue_style( 'admin.css', plugin_dir_url(__FILE__) . 'css/admin.css');

	wp_enqueue_style( 'style.css', plugin_dir_url(__FILE__) . 'css/admin.css');

	wp_enqueue_style( 'pagination.css', plugin_dir_url(__FILE__) . 'css/pagination.css');

	wp_enqueue_style( 'chosen.css', plugin_dir_url(__FILE__) . 'chosen.css');

	wp_enqueue_style( 'upb.css', plugin_dir_url(__FILE__) . 'css/upb.css');

	wp_enqueue_style( 'SpryTabbedPanels.css', plugin_dir_url(__FILE__) . 'css/SpryTabbedPanels.css');

	wp_enqueue_script( 'scriptaculous' );

	wp_enqueue_script( 'chosen.jquery.js',  plugin_dir_url(__FILE__) . 'chosen.jquery.js');

	wp_enqueue_script( 'prism.js',  plugin_dir_url(__FILE__) . 'docsupport/prism.js' );

	wp_enqueue_script( 'SpryTabbedPanels.js',  plugin_dir_url(__FILE__) . 'js/SpryTabbedPanels.js');

}



add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );



add_action( 'admin_init', 'admin_theme_name_scripts' );



add_action('admin_menu', 'ultimate_profile_builder_menu');



/*Defines menu and sub-menu items in dashboard*/



	function ultimate_profile_builder_menu()

	{

		add_menu_page("Ultimate Profile Builder","Ultimate Profile Builder","manage_options","UltimatePB_settings","UltimatePB_settings",plugins_url('/images/profile-icon2.png', __FILE__));

		add_submenu_page("UltimatePB_settings","Add User Role","Add User Role","manage_options","UltimatePB_Custom_User_Role","UltimatePB_Custom_User_Role");

		add_submenu_page("UltimatePB_settings","Manage User Roles","Manage User Roles","manage_options","UltimatePB_Manage_Custom_User_Roles","UltimatePB_Manage_Custom_User_Roles");

		add_submenu_page("UltimatePB_settings","Manage Custom Fields","Manage Custom Fields","manage_options","UltimatePB_Fields","UltimatePB_Fields");

		add_submenu_page("UltimatePB_settings","Support","Support","manage_options","UltimatePB_Support","UltimatePB_Support");

		add_submenu_page("UltimatePB_settings","Pro","Pro","manage_options","UltimatePB_Premium","UltimatePB_Premium");

		add_submenu_page("","New Field","New Field","manage_options","UltimatePB_Field","UltimatePB_Field");

		add_submenu_page("","Edit Field","Edit Field","manage_options","UltimatePB_Field_edit","UltimatePB_Field_edit");

	}

	

	function add_upb_menu_adminbar() {

		global $wp_admin_bar;



		$wp_admin_bar->add_menu( array(

			'id'    => 'add-upb-user-role',

			'title' => 'User Role',

			'href'  => admin_url().'admin.php?page=UltimatePB_Custom_User_Role',

			'parent'=>'new-content'

		));

		$wp_admin_bar->add_menu( array(

			'id'    => 'add-upb-custom-field',

			'title' => 'User Field',

			'href'  => admin_url().'admin.php?page=UltimatePB_Field',

			'parent'=>'new-content'

		));

	}

	add_action( 'wp_before_admin_bar_render', 'add_upb_menu_adminbar' ); 

	

	function UltimatePB_settings()

	{

		include 'UPB_config.php';

		include 'upboption.php';

	}

	

	function UltimatePB_Support()

	{

		include 'UPB_config.php';

		include 'UPB_support.php';

	}

	

	function UltimatePB_Premium()

	{

		wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'css/premium.css');

		include 'UPB_config.php';

		include 'UPB_premium.php';

	}

	

	function UltimatePB_Fields()

	{

		include 'UPB_config.php';

		include 'UPB_form_fields.php';

	}



	function UltimatePB_Field()

	{

		include 'UPB_config.php';

		include 'UPB_form_field.php';

	}



	function UltimatePB_Custom_User_Role()

	{

		include 'UPB_config.php';

		include 'UPB_user_role.php';

	}

	

	function UltimatePB_Manage_Custom_User_Roles()

	{

		include 'UPB_config.php';

		include 'UPB_manage_user_roles.php';

	}





	function UltimatePB_Field_edit()

	{

		include 'UPB_config.php';

		include 'UPB_form_field_edit.php';	

	}

	

	

	function UPB_view_profile_fun( $content )

	{

		wp_enqueue_script( 'mocha.js',  plugin_dir_url(__FILE__) . 'js/mocha.js');

		include 'UPB_config.php';

		include 'UPB_theme.php';

		include 'UPB_view_profile_file.php';

		return $content;

	}

/*Defines relation between shortcodes and corresponding files*/

	add_shortcode( 'UPB_profile', 'UPB_view_profile_fun' );



	function UPB_login_fun( $content )

	{

		include 'UPB_config.php';

		include 'UPB_login_file.php';

		return $content;

	}



	add_shortcode( 'UPB_auth', 'UPB_login_fun' );

	function UPB_recover_password_fun( $content )

	{

		include 'UPB_config.php';

		include 'UPB_recover_password_file.php';

		return $content;

	}



	add_shortcode( 'UPB_forgot_password', 'UPB_recover_password_fun' );

	

	function UPB_register_fun( $content )

	{

		wp_enqueue_script( 'mocha.js',  plugin_dir_url(__FILE__) . 'js/mocha.js');

		include 'UPB_config.php';

		include 'UPB_register_file.php';

	}

	add_shortcode( 'UPB_account', 'UPB_register_fun' );

	

	function UPB_profile_list_fun( $content )

	{

		include 'UPB_config.php';

		include 'UPB_profile_list_file.php';

	}

	

	add_shortcode('UPB_profile_list', 'UPB_profile_list_fun'); 

	

	add_action('wp_ajax_fetch_pages', 'UPB_fetch_pages');

	

	add_action('wp_ajax_nopriv_fetch_pages', 'UPB_fetch_pages');

	

	/*Hooks for AJAX files*/

	function UPB_fetch_pages()

	{

		global $wpdb;

		include('fetch_pages.php');die;

	}

	

	add_action('wp_ajax_ajaxcalls', 'UPB_ajaxcalls');



	add_action('wp_ajax_nopriv_ajaxcalls', 'UPB_ajaxcalls');

	

	function UPB_ajaxcalls()

	{

		global $wpdb;

		include('ajaxCalls.php');

		die;

	}

	add_action('wp_ajax_check_fieldname', 'UPB_check_fieldname');

	

	add_action('wp_ajax_nopriv_check_fieldname', 'UPB_check_fieldname');

	function UPB_check_fieldname()

	{

		global $wpdb;

		include('check_field_name.php');die;

	}



	add_action('wp_ajax_activate_theme', 'UPB_activate_theme');

	add_action('wp_ajax_nopriv_activate_theme', 'UPB_activate_theme');

	

	function UPB_activate_theme()

	{

		global $wpdb;

	

		include('activate_theme.php');die;

	}

add_filter( 'widget_text', 'shortcode_unautop');

add_filter( 'widget_text', 'do_shortcode');