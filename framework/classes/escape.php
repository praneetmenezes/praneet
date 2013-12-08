<?php
class escape
{
public function alphanumeric($string='')
{
$string=trim($string);
$string=preg_replace("/[^A-Za-z0-9 ]/", '', $string);
return $string;
}
public function char($string)
{
$string=trim($string);
$string=preg_replace("/[^A-Za-z]/", '', $string);
return $string;
}
public function integer($string)
{
$string=trim($string);
$string=preg_replace("/[^0-9]/", '', $string);
return $string;
}
}
?>