<?php
if (!empty($_GET['u']))
{
	$c = file_get_contents('http://musicsupervisorguide.yalepartnership.com/js/remote/1/' . $_GET['u'] . '/username/33e75ff09dd601bbe69f351039152189');	
	$cid = json_decode($c);
	$cookie_expires = 1 * 60 * 60 * 24 * 365;
	$cookie_domain = '.musicsupervisorguide'; //DON'T FORGET THE . (dot) before the domain
	setcookie('jamcom', $cid['value'], time()+$cookie_expires,"/", $cookie_domain);
}

//header("HTTP/1.1 301 Moved Permanently");
header("Location:http://musicsupervisorguide.yalepartnership.com/index.php/refer/id/");

?>
