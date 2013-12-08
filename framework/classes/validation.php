<?php
class validation
{
public function email($string='')
{
	$string=trim($string);
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
	return (preg_match($pattern, $string) === 1)?true:false;
}
public function username($string='') {
	$string=trim($string);
	$allowed = array(".", "-", "_");
	return ( ctype_alnum( str_replace($allowed, '', $string ) ) )?true:false;
   
}
public function url($string=''){
	$string=trim($string);
	$regex = "((https?|ftp)\:\/\/)?";
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";  
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
    $regex .= "(\:[0-9]{2,5})?"; 
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";  
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; 
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; 
       return (preg_match("/^$regex$/", $string))?true:false;
	 }  
public function creditcard($cc_number) {
    $card_type = "";
    $card_regexes = array(
      "/^4\d{12}(\d\d\d){0,1}$/" => "visa",
      "/^5[12345]\d{14}$/"       => "mastercard",
      "/^3[47]\d{13}$/"          => "amex",
      "/^6011\d{12}$/"           => "discover",
      "/^30[012345]\d{11}$/"     => "diners",
      "/^3[68]\d{12}$/"          => "diners",
   );
   foreach ($card_regexes as $regex => $type) {
       if (preg_match($regex, $cc_number)) {
           $card_type = $type;
           break;
       }
   }
   if (!$card_type) {
       return false;
   }
   $revcode = strrev($cc_number);
   $checksum = 0; 
   for ($i = 0; $i < strlen($revcode); $i++) {
       $current_num = intval($revcode[$i]);  
       if($i & 1) { 
          $current_num *= 2;
       }      
           $checksum += $current_num % 10; if
       ($current_num >  9) {
           $checksum += 1;
       }
   } 
   return ($checksum % 10 == 0)?true:false;
}
public function date($mydate='',$format = 'DD-MM-YYYY') {
	$mydate=trim($mydate);
	$format=strtoupper(trim($format));
    if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $mydate);
    if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $mydate);
    if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $mydate);
    if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $mydate);
    if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $mydate);
    if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $mydate);
    if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $mydate);
    if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $mydate);
    if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $mydate);  
    if ($format == 'YY-MM-DD') list($year, $month, $day) = explode('-', $mydate);
    if ($format == 'YY/MM/DD') list($year, $month, $day) = explode('/', $mydate);
    if ($format == 'YY.MM.DD') list($year, $month, $day) = explode('.', $mydate);
    if ($format == 'DD-MM-YY') list($day, $month, $year) = explode('-', $mydate);
    if ($format == 'DD/MM/YY') list($day, $month, $year) = explode('/', $mydate);
    if ($format == 'DD.MM.YY') list($day, $month, $year) = explode('.', $mydate);
    if ($format == 'MM-DD-YY') list($month, $day, $year) = explode('-', $mydate);
    if ($format == 'MM/DD/YY') list($month, $day, $year) = explode('/', $mydate);
    if ($format == 'MM.DD.YY') list($month, $day, $year) = explode('.', $mydate);     
    if (is_numeric($year) && is_numeric($month) && is_numeric($day))
    {
    return checkdate($month,$day,$year);
	}
	else
	{
    return false;           
    }
 }         
public static function ip($string='')
{
$string=trim($string);
if(strlen($string)<16 and substr_count($string, '.')==3 and !empty($string))
{	
	$string=str_replace('.', '', $string);
	return (is_numeric($string))?true:false;
}
else
{
	return false;
}
}
public function image($img){ 
    if (!file_exists($img))return false;
    return (getimagesize($img))?true:false;       
} 
}
?>