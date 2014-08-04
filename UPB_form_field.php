<?php

global $wpdb;
$upb_fields =$wpdb->prefix."upb_fields";
$upb_usermeta =$wpdb->prefix."usermeta";
$path =  plugin_dir_url(__FILE__); 
if($_POST['field_submit'])
{
$usergroups = implode(",",$_POST['field_user_groups']);	
//echo $usergroups;die;
//print_r($_POST);die;
$qry = "insert into $upb_fields values('','".$_POST['select_type']."','".$_POST['field_name']."','".$_POST['field_value']."','".$_POST['field_class']."','".$_POST['field_maxLenght']."','".$_POST['field_cols']."','".$_POST['field_rows']."','".$_POST['field_Options']."','".$_POST['field_Des']."','".$_POST['field_require']."','".$_POST['field_readonly']."','".$_POST['field_visibility']."','".$_POST['field_ordering']."','".$usergroups."','".$_POST['field_registration']."')";

$wpdb->query($qry);
//mysql_query($qry);
	$current_user = wp_get_current_user();
	$current_ID = $current_user->ID;
	$meta_key = str_replace(" ","_",$_POST['field_name']);
	$meta_value = "";
	$unique = "";
	add_user_meta( $current_ID, $meta_key, $meta_value, $unique );
	//$qry2 = "select * from ";
	//$qry2 = "insert into $upb_usermeta values('','','','')";
	header("location:admin.php?page=UltimatePB_Fields");
}
?>
<script>	
function getfields(a)
{
	jQuery('#user_groupsfield').show();
	if(a=='text' || a=='password')
	{
		jQuery('#namefield').show();
		jQuery('#classfield').show();
		jQuery('#desfield').show();
		jQuery('#maxlenghtfield').show();
		jQuery('#requirefield').show();
		jQuery('#visibilityfield').show();
		jQuery('#rulesfield').show();
		jQuery('#readonlyfield').hide();
		jQuery('#registrationformfield').show();
		jQuery('#colsfield').hide();
		jQuery('#rowsfield').hide();
		jQuery('#optionsfield').hide();
		jQuery('#valuefield').hide();
		jQuery('#submit_field').show();
		jQuery('#orderingfield').show();
			
	}
	if(a=='submit' || a=='reset' ||  a=='hidden')
	{
		jQuery('#namefield').show();
		jQuery('#classfield').show();
		jQuery('#valuefield').show();
		jQuery('#submit_field').show();
		jQuery('#orderingfield').show();
		jQuery('#desfield').hide();
		jQuery('#maxlenghtfield').hide();
		jQuery('#requirefield').hide();
		jQuery('#visibilityfield').hide();
		jQuery('#rulesfield').hide();
		jQuery('#readonlyfield').hide();
		jQuery('#colsfield').hide();
		jQuery('#rowsfield').hide();
		jQuery('#optionsfield').hide();
		jQuery('#registrationformfield').hide();
	}
	if(a=='select' || a=='radio' || a=='checkbox')
	{
		jQuery('#namefield').show();
		jQuery('#classfield').show();
		jQuery('#optionsfield').show();
		jQuery('#desfield').show();
		jQuery('#valuefield').show();
		jQuery('#requirefield').hide();
		jQuery('#visibilityfield').show();
		jQuery('#rulesfield').show();
		jQuery('#readonlyfield').show();
		jQuery('#registrationformfield').show();
		jQuery('#submit_field').show();
		jQuery('#orderingfield').show();
		jQuery('#maxlenghtfield').hide();
		jQuery('#colsfield').hide();
		jQuery('#rowsfield').hide();
	}
	if(a=='select')
	{
	jQuery('#requirefield').show();	
	}
	if(a=='textarea')
	{
		jQuery('#namefield').show();
		jQuery('#classfield').show();
		jQuery('#desfield').show();
		jQuery('#requirefield').show();
		jQuery('#visibilityfield').show();
		jQuery('#rulesfield').show();
		jQuery('#readonlyfield').show();
		jQuery('#registrationformfield').show();
		jQuery('#colsfield').show();
		jQuery('#rowsfield').show();
		jQuery('#submit_field').show();
		jQuery('#orderingfield').show();
		jQuery('#maxlenghtfield').show();
		jQuery('#optionsfield').hide();
		jQuery('#valuefield').hide();
	}
	if(a=='file')
	{
		jQuery('#namefield').show();
		jQuery('#classfield').show();
		jQuery('#desfield').show();
		jQuery('#requirefield').show();
		jQuery('#visibilityfield').show();
		jQuery('#rulesfield').show();
		jQuery('#readonlyfield').show();
		jQuery('#registrationformfield').show();
		jQuery('#submit_field').show();
		jQuery('#orderingfield').show();
		jQuery('#maxlenghtfield').hide();
		jQuery('#colsfield').hide();
		jQuery('#rowsfield').hide();
		jQuery('#optionsfield').hide();
		jQuery('#valuefield').hide();
	}	
}
</script>
  <?php /*?><link rel="stylesheet" href="<?php echo $path; ?>chosen.css"><?php */?>
  <style type="text/css" media="all">

    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }

	.chosen-container{ min-width:200px !important;}

	ul.chosen-choices li.search-field input{ width:auto !important;}

  </style>
<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/upb.css"><?php */?>
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
<style>
.form_field p{ display:none;}
#selectfieldtype{ display:block;}

</style>
 
<?php
$qrycount = "select count(*) from $upb_fields";
$num_rowscount =$wpdb->get_var($qrycount);
//$regcount = mysql_query($qrycount);
//$num_rowscount = mysql_num_rows($regcount);
?>
<form method="post" action="">
  <div class="form_field">
    <p id="selectfieldtype">
      <label for="select_type">Select Type:</label>
      <select name="select_type" id="select_type" onChange="getfields(this.value)">
        <option value="">Select A Field</option>
        <option value="text">Text Field</option>
        <option value="select">Drop Down</option>
        <!--<option value="file">File</option>-->
        <option value="radio">Radio Button</option>
        <option value="textarea">Text Area</option>
        <option value="checkbox">Check Box</option>
        <!--<option value="hidden">Hidden Field</option>
        <option value="password">Password Field</option>
        <option value="file">File</option>
        <option value="reset">reset</option>
        <option value="submit">submit button</option>-->
      </select>
	</p>
    <p id="user_groupsfield">
    <label for="field_user_groups">Assign User Role(s)</label>
    <select data-placeholder="Choose User Role..." name="field_user_groups[]" id="field_user_groups[]" class="chosen-select" multiple="multiple" tabindex="4" required>
            <option value=""></option>
            <?php
			$roles = get_editable_roles();
foreach($roles as $key=>$role)
{
	echo '<option value="'.$key.'">'.$role['name'].'</option>';	
}
?>
   </select>	
    </p>
    <p id="namefield">
      <label for="field_name">Label</label>
      <input type="text" name="field_name" id="field_name" required onBlur="check()">
    </p>
    <p id="valuefield">
      <label for="field_value"> Default Value</label>
      <input type="text" name="field_value" id="field_value">
      <div id="user-result"></div>
    </p>
    <p id="maxlenghtfield">
      <label for="field_maxLenght">Maximum Length</label>
      <input type="text" name="field_maxLenght" id="field_maxLenght">
    </p>
    <p id="colsfield">
      <label for="field_cols">Columns</label>
      <input type="text" name="field_cols" id="field_cols">
    </p>
    <p id="rowsfield">
      <label for="field_rows">Rows</label>
      <input type="text" name="field_rows" id="field_rows">
    </p>
    <p id="optionsfield">
      <label for="field_Options">Options <small style="float:left;">(value seprated by comma ",")</small></label>
      <textarea type="text" name="field_Options" id="field_Options" cols="25" rows="5"></textarea>
    </p>
    <p id="desfield">
      <label for="field_Des">Description</label>
      <textarea type="text" name="field_Des" id="field_Des" cols="25" rows="5"></textarea>
    </p>
	<input type="hidden" name="field_visibility" id="field_visibility" value="1"/>
    <p id="orderingfield">
      <label for="field_ordering">Ordering</label>
      <select name="field_ordering" id="field_ordering" required>
      <option value="">Select Ordering</option>
      <?php 
	  $qrytotalrows = "SELECT count(*) FROM $upb_fields";
	  $totalrows = $wpdb->get_var($qrytotalrows) + 1;
	  //$regtotalrows = mysql_query($qrytotalrows);

	 // $totalrows = mysql_num_rows($regtotalrows) + 1;
	  for($i=1;$i<=$totalrows;$i++)
	  {?>
			<option value="<?php echo $i;?>"><?php echo $i;?></option>  
	<?php }  ?>
      </select>
    </p>
 	<p id="submit_field">
    <input type="submit" id="field_submit" name="field_submit" class="button-primary" value="Save" style="width:auto;" />
    </p>
  </div>
</form>
</div>
</div>

  <script type="text/javascript">
    var config = {

      '.chosen-select'           : {},

      '.chosen-select-deselect'  : {allow_single_deselect:true},

      '.chosen-select-no-single' : {disable_search_threshold:10},

      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},

      '.chosen-select-width'     : {width:"95%"}

    }

    for (var selector in config) {

      jQuery(selector).chosen(config[selector]);

    }

  </script>

  <script type="text/javascript">

  function check() { //user types username on inputfiled

  	 //get the string typed by user

	 name = jQuery("#field_name").val();

   jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=check_fieldname&cookie=encodeURIComponent(document.cookie)', {'name':name}, function(data) { 
   //make ajax call to check_username.php
   if(data=="")
   {
	  jQuery("#user-result").html('');
	 // jQuery("#submit_field").show();
	  jQuery("#submit_field").css('display','block');
	  
   }
   else
   {
   jQuery("#user-result").html(data);
   jQuery("#submit_field").hide();
   }
    //dump the data received from PHP page

   });

}
  </script>