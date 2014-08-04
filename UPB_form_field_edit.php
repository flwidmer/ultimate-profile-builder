<?php
global $wpdb;
$upb_fields =$wpdb->prefix."upb_fields";
$path =  plugin_dir_url(__FILE__); 
?>

<style>
.form_field p{ display:none;}
#selectfieldtype{ display:block;}
</style>
<?php /*?><link rel="stylesheet" href="<?php echo $path; ?>chosen.css"><?php */?>
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
	.chosen-container{ min-width:200px !important;}
	ul.chosen-choices li.search-field input{ width:auto !important;}
  </style>
<script> 
function getfields(a)
{
	jQuery('#user_groupsfield').show();
	if(a=='text' || a=='password')
	{
		//alert(a);
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
		jQuery('#registrationformfield').show();
		jQuery('#readonlyfield').show();
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
		jQuery('#registrationformfield').show();
		jQuery('#visibilityfield').show();
		jQuery('#rulesfield').show();
		jQuery('#readonlyfield').show();
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
<?php
if($_POST['field_submit'])
{
$usergroups = implode(",",$_POST['field_user_groups']);	
$qry = "update $upb_fields set Type = '".$_POST['select_type']."',Name = '".$_POST['field_name']."', Value ='".$_POST['field_value']."', Class ='".$_POST['field_class']."', Max_Length ='".$_POST['field_maxLenght']."',Cols='".$_POST['field_cols']."',Rows='".$_POST['field_rows']."',Option_Value ='".$_POST['field_Options']."', Description = '".$_POST['field_Des']."', `Require` ='".$_POST['field_require']."',Readonly ='".$_POST['field_readonly']."',Visibility='".$_POST['field_visibility']."',Ordering ='".$_POST['field_ordering']."',user_group='".$usergroups."',registration='".$_POST['field_registration']."' where Id=".$_POST['field_id'];
$wpdb->query($qry);
	//mysql_query($qry);
	$current_user = wp_get_current_user();
	$current_ID = $current_user->ID;
	$meta_key = str_replace(" ","_",$_POST['field_name']);
	$meta_value = "";
	$unique = "";
	update_user_meta( $current_ID, $meta_key, $meta_value, $unique );
	header("location:admin.php?page=UltimatePB_Fields");
}
if($_POST['id'])
{
	if($_POST['delete_field'])
	{
		$qry = "delete from $upb_fields where Id=".$_POST['id'];
		$wpdb->query($qry);	
		//mysql_query($qry);
		header("location:admin.php?page=UltimatePB_Fields");
	}
	if($_POST['edit_field'])
	{
		$qry ="select * from $upb_fields where Id =".$_POST['id'];
		//$reg = mysql_query($qry);
		$row = $wpdb->get_row($qry);
		//$row = mysql_fetch_row($reg);
		//print_r($reg);die;
		$str=preg_replace('/[\s]+/',' ',$row->Type);
	}
}
?>
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
<form method="post" action="">
  <div class="form_field">
    <p id="selectfieldtype">
    <input type="hidden" name="field_id" id="field_id" value="<?php echo $row->Id; ?>" />
      <label for="select_type">Select Type:</label>
      <select name="select_type" id="select_type" onChange="getfields(this.value)">
        <option value="">Select A Field</option>
        <option value="text" <?php if($str=='text') echo 'selected'; ?>>Text Field</option>
        <option value="select" <?php if($str=='select') echo 'selected'; ?>>selectbox</option>
        <!--<option value="file" <?php if($str=='file') echo 'selected'; ?>>File</option>-->
        <option value="radio" <?php if($str=='radio') echo 'selected'; ?>>Radio button</option>
        <option value="textarea" <?php if($str=='textarea') echo 'selected'; ?>>Text Area</option>
        <option value="checkbox" <?php if($str=='checkbox') echo 'selected'; ?>>checkbox</option>
    <!--    <option value="hidden" <?php if($str=='hidden') echo 'selected'; ?>>Hidden Field</option>
        <option value="password" <?php if($str=='password') echo 'selected'; ?>>Password Field</option>
        <option value="file" <?php if($str=='file') echo 'selected'; ?>>File</option>
        <option value="reset" <?php if($str=='reset') echo 'selected'; ?>>reset</option>
        <option value="submit" <?php if($str=='submit') echo 'selected'; ?>>submit button</option>-->
      </select>
    </p>
<p id="user_groupsfield">
    <label for="field_user_groups">Select User group</label>
    <select data-placeholder="Choose User Group..." name="field_user_groups[]" id="field_user_groups[]" class="chosen-select" multiple="multiple" tabindex="4" required>
            <option value=""></option>
            <?php
			$roles = get_editable_roles();
foreach($roles as $key=>$role)
{?>
	<option value="<?php echo $key; ?>" <?php if (strpos($row->user_group, $key) !== false) echo 'selected';?>><?php echo $role['name']; ?></option>	

<?php } ?>
          </select>	
    </p>
    <p id="namefield">
      <label for="field_name">Name</label>
      <input type="text" name="field_name" id="field_name" value="<?php echo $row->Name;?>" required onBlur="check()">
	<div id="user-result"></div>
    </p>
    <p id="valuefield">
      <label for="field_value"> Default Value</label>
      <input type="text" name="field_value" id="field_value" value="<?php echo $row->Value;?>">
    </p>
    <p id="maxlenghtfield">
      <label for="field_maxLenght">MaxLenght</label>
      <input type="text" name="field_maxLenght" id="field_maxLenght" value="<?php echo $row->Max_Length;?>">
    </p>
    <p id="colsfield">
      <label for="field_cols">Cols</label>
      <input type="text" name="field_cols" id="field_cols" value="<?php echo $row->Cols;?>">
    </p>
    <p id="rowsfield">
      <label for="field_rows">Rows</label>
      <input type="text" name="field_rows" id="field_rows" value="<?php echo $row->Rows;?>">
    </p>
    <p id="optionsfield">
      <label for="field_Options">Options <small style="float:left;">(value seprated by comma ",")</small></label>
      <textarea type="text" name="field_Options" id="field_Options" cols="25" rows="5"><?php echo $row->Option_Value;?></textarea>
    </p>
    <p id="desfield">
      <label for="field_Des">Description</label>
      <textarea type="text" name="field_Des" id="field_Des" cols="25" rows="5"><?php echo $row->Description;?></textarea>
    </p>
<input type="hidden" name="field_visibility" id="field_visibility" value="1">
    <p id="orderingfield">
      <label for="field_ordering">Ordering</label>
      <select name="field_ordering" id="field_ordering" required>
      <option value="">select ordering</option>
      <?php 
	  $qry = "SELECT count(*) FROM $upb_fields";
	  //$reg = mysql_query($qry);
	  $totalrows = $wpdb->get_var($qry) +1;
	 // $totalrows = mysql_num_rows($reg) + 1;
	  for($i=1;$i<=$totalrows;$i++)
	  {?>
			<option value="<?php echo $i;?>" <?php if($row->Ordering==$i)echo 'selected';?>><?php echo $i;?></option>  

	  <?php } ?>
      </select>
    </p>
 	<p id="submit_field">
    <input type="submit" id="field_submit" name="field_submit" class="button-primary" value="Update Field" style="width:auto;" />
    </p>
  </div>
</form>
</div>
</div>
<script>
getfields("<?php echo $str;?>");
</script>

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

   jQuery.post('<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=check_fieldname&cookie=encodeURIComponent(document.cookie)', {'name':name,'prevalue':'<?php echo $row->Name;?>'}, function(data) { 

   //make ajax call to check_username.php

   if(data=="")

   {
	  jQuery("#user-result").html('');  
	  jQuery("#submit_field").show();
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