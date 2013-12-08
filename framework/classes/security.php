<?php
class security 
{
public function xss($string)
{
	$string=trim($string);
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
public function sqlinjection($string)
{
	$string=trim($string);
    if(DATABASE===true)
    {
	   return mysql_real_escape_string($string);
    }
    else
    {
        return stripslashes($string);
    }    
}
public function ip($ip){
	if(validation::ip($ip))
	{
	$listed = 0;
	$dnsbl_lookup=array("dnsbl-1.uceprotect.net","dnsbl-2.uceprotect.net","dnsbl-3.uceprotect.net","dnsbl.dronebl.org","dnsbl.sorbs.net","zen.spamhaus.org");
	if($ip){
		$reverse_ip=implode(".",array_reverse(explode(".",$ip)));
		foreach($dnsbl_lookup as $host){
			if(checkdnsrr($reverse_ip.".".$host.".","A")){
				$listed = $reverse_ip.'.'.$host.' <font color="red">Listed</font><br />';
			}
		}
	}
	return ($listed != 0)?true:false;
}
}
public function crawler()
{
	$USER_AGENT=$_SERVER['HTTP_USER_AGENT'];
    $crawlers = array(
    array('Google', 'Google'),
    array('msnbot', 'MSN'),
    array('Rambler', 'Rambler'),
    array('Yahoo', 'Yahoo'),
    array('AbachoBOT', 'AbachoBOT'),
    array('accoona', 'Accoona'),
    array('AcoiRobot', 'AcoiRobot'),
    array('ASPSeek', 'ASPSeek'),
    array('CrocCrawler', 'CrocCrawler'),
    array('Dumbot', 'Dumbot'),
    array('FAST-WebCrawler', 'FAST-WebCrawler'),
    array('GeonaBot', 'GeonaBot'),
    array('Gigabot', 'Gigabot'),
    array('Lycos', 'Lycos spider'),
    array('MSRBOT', 'MSRBOT'),
    array('Scooter', 'Altavista robot'),
    array('AltaVista', 'Altavista robot'),
    array('IDBot', 'ID-Search Bot'),
    array('eStyle', 'eStyle Bot'),
    array('Scrubby', 'Scrubby robot')
    );
    foreach ($crawlers as $c)
    {
        if (stristr($USER_AGENT, $c[0]))
        {
            return true;
        }
    }
    return false;
}
public function randchars($string) {
	$string=intval($string);
	$string--;
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array();
	$alphaLength = strlen($alphabet) - 1; 
	for ($i = 0; $i <=$string; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
        return implode($pass);
}
}
?>