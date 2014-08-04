<?php

//session_start();
if($_POST['field_user_role'])
{
$_SESSION['selectfield'] = $_POST['field_user_role'];
}
$path =  plugin_dir_url(__FILE__); 
global $wpdb;
$upb_fields =$wpdb->prefix."upb_fields";
?>
<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/upb.css"><?php */?>

<div class="main">

  <div class="header"></div>

  <div class="content-wrap">

    <div class="pre-s-main">

      <div class="pre-s-top-part">

        <div class="pres-s-left-icon"> <img src="<?php echo $path; ?>images/upb-logo.jpg"/> </div>

       <div class="pres-s-heading" style="margin-top:15px;">
        <a href="http://cmshelplive.com/chl-products/ultimate-profile-builder-pro.html" ><img src="<?php echo $path; ?>images/pro-banner-ubp.jpg" /></a>
		</div>

		<br>

		<div class="header_part">

        <form method="post">

         <label for="field_user_groups">Select User Role</label>

    		<select name="field_user_role" id="field_user_role" onChange="submit()">

            <option value=""></option>

            <?php

			$roles = get_editable_roles();
foreach($roles as $key=>$role)

{ ?>

	<option value="<?php echo $key; ?>" <?php if($key == $_SESSION['selectfield'])echo 'selected'; ?>><?php echo $role['name']; ?></option>

<?php }

?>

		

          </select>	

          </form>

          <?php

		  $qrycount = "select count(*) from $upb_fields";
			$num_rowscount = $wpdb->get_var($qrycount);
?>

          <div class="add_new_field"><a href="?page=UltimatePB_Field" class="button-primary">Add New Field</a></div>

      

        </div>

        

        



      </div>



    </div>

<?php if($_SESSION['selectfield']) : ?>

    <div id="profile_fields">



      <div id="container">



        <div class="rows profile-top-user">



          <div class="cols" style="min-width:25px;">Id</div>



          <div class="cols">Field Name</div>



          <div class="cols">Field Type</div>



          <div class="cols" style="min-width:50px;">Ordering</div>



          <div class="cols" style="text-align:right;">Action</div>



          <!--<div class="cols"><a href="?page=UltimatePB_Field">Add Field</a></div>-->



        </div>



        <?php



$qry = "select * from $upb_fields where user_group like '%".$_SESSION['selectfield']."%' order by ordering asc";
$reg = $wpdb->get_results($qry);
//$reg = mysql_query($qry);
if(empty($reg))
{
?>
        <div class="rows">
          <div class="cols" style="width:100%;">Oops! There are no custom fields for this user role.</div>
        </div>
        <?php 	
}
else
{
$i=1;
foreach($reg as $row)
{
?>
        <div class="rows result">
          <div class="cols" style="min-width:25px;"><?php echo $i;?></div>
          <div class="cols"><?php echo $row->Name;?></div>
          <div class="cols"><?php echo $row->Type;?></div>
          <div class="cols" style="min-width:50px;"><?php echo $row->Ordering;?></div>
          <div class="cols" style="text-align:right; min-width:225px;">
          <form method="post" action="admin.php?page=UltimatePB_Field_edit">
              <input type="hidden" value="<?php echo $row->Id;?>" name="id" />
              <input type="submit" class="button" value="Delete" name="delete_field" id="delete_field" onClick="return confirmdelete()">
            </form>
          	<form method="post" action="admin.php?page=UltimatePB_Field_edit">
              <input type="hidden" value="<?php echo $row->Id;?>" name="id" />
              <input type="submit" class="button" value="Edit" name="edit_field" id="edit_field">
            </form>
            </div>
        </div>
        <?php
		$i++;
}


}

?>
      </div>
    </div>
<?php endif; ?>
  </div>
</div>
<script>
function confirmdelete()
{
	var a = confirm("Are you Sure ?");
	if(a==true)
	{
		return true;	
	}
	else
	return false;
}
</script>