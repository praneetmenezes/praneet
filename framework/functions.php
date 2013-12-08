<?php
if(HTTPS===true){
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location: $redirect");
}
}
if(ERROR_LOGGING===true){
error_reporting(E_ALL|E_STRICT);
ini_set('log_errors','On');
ini_set('error_log','errors.log'); 
ini_set('display_errors','Off'); 
}
else
{
    error_reporting(E_ALL|E_STRICT);
}
function get($string)
{
	$string=trim($string);
	if(isset($_GET[$string]))
	{
		return htmlentities(trim($_GET[$string]));
	}
	else
	{
		return "";
	}
}
function post($string)
{
	$string=trim($string);
	if(isset($_POST[$string]))
	{
		return htmlentities(trim($_POST[$string]));
	}
	else
	{
		return "";
	}
}
function cookie($string)
{
	$string=trim($string);
	if(isset($_COOKIE[$string]))
	{
		return htmlentities(trim($_POST[$string]));
	}
	else
	{
		return "";
	}
}
function show($string)
{
	$string=trim($string);
	$var=print htmlentities($string);
	return $var;
}
?>