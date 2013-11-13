<?php

/**
 * @author 
 * @copyright 2013
 */
 $x = @$_POST['x'];
 $y = @$_POST['y']; 
 
//$lat = $_GET['lat'];
//$lat = $_POST['lat'];
//$lng = $_POST['longitude'];
//$date = "2013-01";
//$url = 'http://data.police.uk/api/crimes-street/all-crime?lat='. $lat . "&lng=" . $lng . "&date=" . $date;


include('cPoliceAPI.php');
$policeAPI = new cPoliceAPI();
$mycounty="Shropshire";
//echo '<pre>';
//echo 'test';
//print_r($policeAPI->getStreetLevelCrimes(51.500617,-0.124629));
//print_r("<p>Neighbourhood for 51.500617,-0.124629</p>");
//print_r($policeAPI->locateNeighbourhood(51.500617,-0.124629));
//print_r("<br/>");
//print_r($policeAPI->getNeighbourhoodCrimes('metropolitan','00BK17N'));
//print_r("<br/>");
//print_r("<p id='a'>");
//print_r($policeAPI->getStreetLevelCrimes($lat,$lng));
//print_r("</p>");
$jsontojs = $policeAPI->getStreetLevelCrimes($x,$y);
//$json=json_decode($policeAPI->getStreetLevelCrimes(51.500617,-0.124629));

//$json = ($json);
//print_r($json);
//echo $lat;
echo $jsontojs;
//print_r("<p id='a'>Test" + $jsontojs + "</p>");


?>