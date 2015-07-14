<?php
function ipbetweenrange($needle, $start, $end) {
  if((ip2long($needle) >= ip2long($start)) && (ip2long($needle) <= ip2long($end))) {
    return true;
  }
  return false;
}
$sccDavis = '165.196.0.3';
$flcWifi = '165.196.12.31';
$arcStart = '165.196.26.1';
$arcEnd = '165.196.26.102'; 
$sccWifi = '165.196.26.103';
$arc2Start = '165.196.26.104';
$arc2End = '165.196.26.135';
$crcWifi = '165.196.26.136';
$arc3Start = '165.196.26.137';
$arc3End = '165.196.55.255';
$flcStart = '165.196.56.1';
$flcEnd = '165.196.57.255';
$sccWSStart = '165.196.58.1';
$sccWSEnd = '165.196.64.255';
$arc4Start = '165.196.65.1';
$arc4End = '165.196.123.255';
$flc3Start = '165.196.124.1';
$flc3End = '165.196.125.255';
$crcStart = '165.196.128.1';
$crcEnd = '165.196.159.255';
$flc2Start = '165.196.160.1';
$flc2End = '165.196.192.255';
$sccStart = '165.196.193.1';
$sccEnd = '165.196.254.255';
$sccDavisWifi = '198.189.145.4';


$currentIP = $_SERVER['REMOTE_ADDR'];

// $currentIP = '165.196.162.255'; // for testing

// echo "current IP is: \r\n" .$currentIP . "\nWhich is located at \r\n";
if ((strpos($currentIP, '165.196') > -1) || ($currentIP === $sccDavisWifi)) {

  if ((ipbetweenrange($currentIP, $arcStart, $arcEnd)) || (ipbetweenrange($currentIP, $arc2Start, $arc2End)) || (ipbetweenrange($currentIP, $arc3Start, $arc3End))|| (ipbetweenrange($currentIP, $arc4Start, $arc4End)) ) {
//    echo 'arc';
setHomeLib($ar);
    }
    elseif ((ipbetweenrange($currentIP, $sccStart, $sccEnd)) || (ipbetweenrange($currentIP, $sccWSStart, $sccWSEnd)) || ($currentIP === $sccWifi) || ($currentIP === $sccDavis) || ($currentIP === $sccDavisWifi) ) {
//    echo 'scc';
setHomeLib($sc);
    }
    elseif ((ipbetweenrange($currentIP, $crcStart, $crcEnd)) || ($currentIP === $crcWifi) ) {
setHomeLib($cr);
    }
    elseif ((ipbetweenrange($currentIP, $flcStart, $flcEnd)) || (ipbetweenrange($currentIP, $flc2Start, $flc2End)) || (ipbetweenrange($currentIP, $flc3Start, $flc3End)) || ($currentIP === $flcWifi) ) {
//    echo 'flc';
setHomeLib($fl);
    }
    else {
setHomeLib('unknown');
    }
    }
    else {
      setHomeLib('unknown');
      }
?>


