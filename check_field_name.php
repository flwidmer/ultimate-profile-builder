<?php

global $wpdb;

$upb_fields =$wpdb->prefix."upb_fields";
if($_POST['prevalue'])
{
	$qry = "select count(*) from $upb_fields where Name ='".$_POST['name']."' and Name !='".$_POST['prevalue']."'";
	$result = $wpdb->get_var($qry);
	/*$reg = mysql_query($qry);
	$result = mysql_num_rows($reg);*/
	if($result!=0)
	{

		echo '<div style=" color:red">Warning! Field label already exists. Please choose a unique label.</div>';	
	}
}
else
{
	$qry = "select * from $upb_fields where Name ='".$_POST['name']."'";
	/*$reg = mysql_query($qry);
	$result = mysql_num_rows($reg);*/
	$result = $wpdb->get_var($qry);
	if($result!=0)
	{
		echo '<div style=" color:red">Warning! Field label already exists. Please choose a unique label.</div>';	
	}
}
?>