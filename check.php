<?php


$countusers = count_users();

			//print_r($countusers);

if($countusers['total_users']>=100)

{

echo '<div style="float:left;width:100%;" class="error">Oops! You have reached maximum number of profiles for free version. Please consider buying Pro version for unlimited profiles. <a href="http://www.cmshelplive.com/services/marketplace/item/594-ultimate-profile-builder.html">Click here </a>to buy</div>';

}

//echo '<div style="float:left; width:100%;text-align: center;">Powered by <a href="http://www.cmshelplive.com/services/marketplace/item/594-ultimate-profile-builder.html">Ultimate Profile Builder</a></div>';

?>