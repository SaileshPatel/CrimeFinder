<?php
$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$date = "2013-01";
$url = 'http://data.police.uk/api/crimes-street/all-crime?lat='. $lat . "&lng=" . $lng . "&date=" . $date;

echo $url;
?>
