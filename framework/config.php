<?php
define('HTTPS',false);// set to true if your website has ssl certificate 
define('ERROR_LOGGING',false);// set to true if you want error logs 
define("DATABASE",false);// set to true if you have mysql connection
date_default_timezone_set('Asia/Kolkata');// set your time zone
$mysql_hostname = "localhost";// mysql host name
$mysql_user = "dnsx";// mysql username
$mysql_password = "praneet8698937";//mysql password
$mysql_database = "dnsx";// mysql database name
/*
Objects of class
change to values you may find easy to remember
eg: $image=new image; 
eg: $i=new image;
*/
$val= new validation;
$sec=new security;
$gi=new getinfo;
$img=new image;
$esc=new escape;
$upl=new upload;
?>
