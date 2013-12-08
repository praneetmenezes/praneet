<?php
require_once('config.php');
if(DATABASE===true)
{
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database, $bd) or die(mysql_error());
}
?>