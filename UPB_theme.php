<?php
/*Controls theme selection from dashboard*/
$path =  plugin_dir_url(__FILE__);  
$upb_option=$wpdb->prefix."upb_option";
$front_theme = $wpdb->get_var("select value from $upb_option where fieldname='upb_theme'");

if($front_theme=='aqua')
{
 $border_color = '#3977b5';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#4795e3';
 $button_colorLight = '#3977b5';
 $button_hover = '#3977b5';
 $text_shadow = '#3977b5';
}


if($front_theme=='babyblue')
{
 $border_color = '#bed4ea';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#c4ddf7';
 $button_colorLight = '#bed4ea';
 $button_hover = '#bed4ea';
 $text_shadow = '#bed4ea';
}

if($front_theme=='black')
{
 $border_color = '#000000';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#424242';
 $button_colorLight = '#000000';
 $button_hover = '#000000';
 $text_shadow = '#000000';
}

if($front_theme=='blue')
{
 $border_color = '#4b95dd';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#61a8ed';
 $button_colorLight = '#4b95dd';
 $button_hover = '#4b95dd';
 $text_shadow = '#4b95dd';

}

if($front_theme=='bluegreen')
{
 $border_color = '#2f97af';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#3eb8d4';
 $button_colorLight = '#2f97af';
 $button_hover = '#2f97af';
 $text_shadow = '#2f97af';

}

if($front_theme=='blueviolet')
{
 $border_color = '#5233b0';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#7150d7';
 $button_colorLight = '#5233b0';
 $button_hover = '#5233b0';
 $text_shadow = '#5233b0';
}

if($front_theme=='brown')
{
 $border_color = '#a05d19';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#df8223';
 $button_colorLight = '#a05d19';
 $button_hover = '#a05d19';
 $text_shadow = '#a05d19';
}

if($front_theme=='crimson')
{
 $border_color = '#9d1120';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#e01e33';
 $button_colorLight = '#9d1120';
 $button_hover = '#9d1120';
 $text_shadow = '#9d1120';
}

if($front_theme=='deeppink')
{
 $border_color = '#fb4f9a';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#fd70ae';
 $button_colorLight = '#fb4f9a';
 $button_hover = '#fb4f9a';
 $text_shadow = '#fb4f9a';

}

if($front_theme=='forestgreen')
{
 $border_color = '#396634';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#58a150';
 $button_colorLight = '#396634';
 $button_hover = '#396634';
 $text_shadow = '#396634';
}

if($front_theme=='fuchsia')
{
 $border_color = '#b133a5';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#da3dcb';
 $button_colorLight = '#b133a5';
 $button_hover = '#b133a5';
 $text_shadow = '#b133a5';
}

if($front_theme=='light')
{
 $border_color = '#000';
 $backgroundcolor = '#f9f9f9';
 $button_colorLight = '#ffaa00';
 $button_colorDark = '#ffc600';
 $button_hover = '#f1b900';
 $text_shadow = '#e09a00';
}

if($front_theme=='lightgreen')
{
 $border_color = '#5cac35';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#a4eb81';
 $button_colorLight = '#5cac35';
 $button_hover = '#5cac35';
 $text_shadow = '#5cac35';
}

if($front_theme=='lightpink')
{
 $border_color = '#b93b6d';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#ff9bc3';
 $button_colorLight = '#b93b6d';
 $button_hover = '#b93b6d';
 $text_shadow = '#b93b6d';
}

if($front_theme=='lightred')
{
 $border_color = '#a92b2b';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#ff5050';
 $button_colorLight = '#a92b2b';
 $button_hover = '#a92b2b';
 $text_shadow = '#a92b2b';
}

if($front_theme=='lightblue')
{
 $border_color = '#3e9fc7';
 $backgroundcolor = '#f9f9f9';
 $button_colorDark = '#9fe3ff';
 $button_colorLight = '#3e9fc7';
 $button_hover = '#3e9fc7';
 $text_shadow = '#3e9fc7';
}



if($front_theme=='lightmoderngreen')
{
 $border_color = '#70ac1a';
 $backgroundcolor = '#f9f9f9';
 $button_colorLight = '#7cbe1f';
 $button_colorDark = '';
 $button_hover = '#70ac1a';
 $text_shadow = '';
}

if($front_theme=='lightmodernyellow')
{
 $border_color = '#d48200';
 $backgroundcolor = '#f9f9f9';
 $button_colorLight = '#ffba00';
 $button_colorDark = '';
 $button_hover = '#d48200';
 $text_shadow = '';
}
?>
<style>
#main-upb-form {
 background-color: <?php echo $backgroundcolor;
 ?> !important;
 border-top: 8px solid <?php echo $border_color;
 ?> !important;
}
/*-----------------------------------Button CSS Start-----------------------------------*/

.UltimatePB-Button, #upb-form input[type="submit"], #upb-form input[type="reset"] {
 background: <?php echo $button_colorLight;
?>;
 <?php if($front_theme!='lightmoderngreen' && $front_theme!='lightmodernyellow'): ?>  border-top: 1px solid <?php echo $button_colorDark;
?>;
 background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $button_colorDark;
?>), to(<?php echo $button_colorLight;
?>));
 background: -webkit-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -moz-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -ms-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -o-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 text-shadow:0px -1px 0px <?php echo $text_shadow;
?>;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
 <?php endif;
?>  padding: 2px 23px;
	color: white;
	font-size: 16px;
	text-decoration: none;
	vertical-align: middle;
	float: left;
	margin-left: 19px;
	line-height: 25px;
}

.UltimatePB-Button:hover, .UltimatePB-Button:active, #upb-form input[type="submit"]:hover, #upb-form input[type="reset"]:hover, #upb-form input[type="submit"]:active, #upb-form input[type="reset"]:active {
 border-top-color: <?php echo $button_hover;
?>;
 background: <?php echo $button_hover;
?>;
}


.UltimatePB-Button-inp input {
 background: <?php echo $button_colorLight;
?>;
 <?php if($front_theme!='lightmoderngreen' && $front_theme!='lightmodernyellow'): ?>  border-top: 1px solid <?php echo $button_colorDark;
?>;
 background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $button_colorDark;
?>), to(<?php echo $button_colorLight;
?>));
 background: -webkit-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -moz-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -ms-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
 background: -o-linear-gradient(top, <?php echo $button_colorDark;
?>, <?php echo $button_colorLight;
?>);
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
 text-shadow: 0px -1px 0px <?php echo $text_shadow;
?>;
 <?php endif;
?>  padding: 2px 23px;
	color: white;
	font-size: 16px;
	font-family: Arial, "Helvetica LT Std", Tahoma;
	text-decoration: none;
	vertical-align: middle;
	float: left;
	margin-left: 20px;
	line-height: 25px;
}
.UltimatePB-Button-inp input:hover, .UltimatePB-Button-inp input:active {
 background: <?php echo $button_hover;
?>;
	color: #fff;
 <?php if($front_theme!='lightmoderngreen' && $front_theme!='lightmodernyellow'): ?>  border-top-color: <?php echo $button_hover;
?>;
 text-shadow: 0px 0px 0px <?php echo $text_shadow;
?>;
 <?php endif;
?>
}
.UltimatePB-Button a {
	font-family: Arial, "Helvetica LT Std", Tahoma;
	font-size: 16px;
	color: #fff !important;
	text-decoration: none;
 <?php if($front_theme!='lightmoderngreen' && $front_theme!='lightmodernyellow'): ?>  text-shadow:0px -1px 0px <?php echo $text_shadow;
?>;
 <?php endif;
?>
}
.UltimatePB-Button a:hover, .UltimatePB-Button a:active {
	font-family: Arial, "Helvetica LT Std", Tahoma;
	font-size: 16px;
	color: #fff;
	text-decoration: none;
 <?php if($front_theme!='lightmoderngreen' && $front_theme!='lightmodernyellow'): ?>  text-shadow:0px -1px 0px <?php echo $text_shadow;
?>;
 <?php endif;
?>
}
/*-----------------------------------Button CSS Ends-----------------------------------*/



#progressbar {
	width: 238px;
border-color:<?php echo $border_color;
?>;
	height: 15px;
	margin-bottom: 10px;
}
#progressbar .ui-progressbar-value {
background: <?php echo $button_colorLight;
?>;
border-color:<?php echo $border_color;
?>
}
</style>

