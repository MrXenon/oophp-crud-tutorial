<?php
// require files
require_once 'controller/database.php';
require_once 'controller/init.php';
//Connect initilization class.
$init = new Init();

// Define the file name
$file = basename(__FILE__,".php");

// Link for form method
$action_url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Check file name & set new file
if($file == 'index'){ 
    $file ='view/home.php';
}else{
    $file = basename(__FILE__,".php");
}

$action_url = $action_url . $file;

//Include file
header('Location:'. $action_url);
?>