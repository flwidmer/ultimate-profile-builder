<?php

     include 'UPB_config.php';

     $f_name= $_REQUEST['function'];
     switch($f_name)
     {
        case 'validateUser': echo validateUser($_REQUEST['name']); break;
        case 'validateEmail': echo validateEmail($_REQUEST['email']); 
     }

     function validateUser($name)
     {

        return username_exists( $name )>0?"true":"false"; 
     }

     function validateEmail($email)
     {  
        return email_exists( $email )>0?"true":"false"; 
     }
     die;

?>