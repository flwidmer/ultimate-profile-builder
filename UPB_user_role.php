<?php 

global $wpdb;
$path =  plugin_dir_url(__FILE__); 
if($_POST['role_submit'])
{
$parentrole = get_role( $_POST['parent_role'] );	
add_role( str_replace(" ","_",$_POST['role_name']), $_POST['role_name'], $parentrole->capabilities );

$qry_group = "insert into $upb_group(name) values('".str_replace(" ","_",$_POST['role_name'])."')";
$wpdb->query($qry_group);
//mysql_query($qry_group);

$message = 'New Role "'.$_POST['role_name'].'" successfully created!';

}

$roles = get_editable_roles();

?>


<div class="main">



	<div class="header"></div>



	<div class="content-wrap">

<div class="pre-s-main">



	<div class="pre-s-top-part">



    	<div class="pres-s-left-icon">



        	<img src="<?php echo $path; ?>images/upb-logo.jpg"/>



		</div>



        <div class="pres-s-heading" style="margin-top:15px;">
        <a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html" ><img src="<?php echo $path; ?>images/pro-banner-ubp.jpg" /></a>
		</div>



	</div>



</div>

<?php

if($message!=""): ?>

<div class="parent_Role">

<?php echo '<h3 class="upb_message">'.$message.'</h3>'; ?> 

<h4 class="newrole"><a href="?page=UltimatePB_Custom_User_Role">Click here</a> to add another Role <br> or </br> Start <a href="?page=UltimatePB_Fields" >adding custom fields</a> to your Role now</h4>

</div>

<?php else: ?>

<div class="parent_Role">

<?php 

$qry = "select count(*) from $upb_group";
$count = $wpdb->get_var($qry);
/*$reg = mysql_query($qry);

$count = mysql_num_rows($reg);*/




?>



<form  name="add_role" id="add_role" action="" method="post">

<p>

<label>New Role Name: </label><input id="role_name" name="role_name" class="role_name" type="text" >

</p>

<p>

<label>Select Permission Level: </label><select name="parent_role" id="parent_role">

<?php

foreach($roles as $key=>$role)

{

	echo '<option value="'.$key.'">'.$role['name'].'</option>';	

}

?>

</select>

</p>

<p>

<input id="role_submit" name="role_submit" class="role_submit" type="submit" >

</p>

</form>


</div>

<?php endif; ?>

</div>

</div>



