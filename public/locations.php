<?php
$start = $_GET["start"];
if($start == null){
	die("you need to put a start location");
}
$startMain = $_GET["start"];
$locsString = $_GET["locs"];
$locsStringExcaped = urlencode($locsString);
$locs = explode("|", $locsString);

$careKey = "duration";
$careKey = "distance";

$locsLeft = $locs;
$addressLookup = array();
$stops = array();

$app = isset($_GET["app"]);
if(!$app){
	echo("Input Path:\n<br>");

	echo("<ul>");
	echo("<li>$startMain</li>");
	foreach($locs as $stop){
		echo("<li>$stop</li>");
	}
	echo("</ul>");
}
while(count($locsLeft) != 0){
   //echo("Count of locs left: ".count($locsLeft));
   $stop = get_next_stop();	
   array_push($stops, $stop["loc"]);
   array_push($stopsFullname, $stop["loc"]);
  
}

$maplink = make_map_link($stops);

if(!$app){
echo("\n");

echo("<br>Best Path ($careKey):\n<br>");
echo("<ul>");
echo("<li>$startMain</li>");
foreach($stops as $stop){
	echo("<li>$stop (".$addressLookup[$stop].")</li>");
}
echo("</ul>");


echo("<br><br><a href='$maplink' target='_blank'>View in maps</a>");
}

if($app){
header('Content-type: application/json');
echo(json_encode(array("stops"=>$stops, "link"=>$maplink, "status"=>"200"),true));
}


function make_map_link($stops){
	global $startMain;
	$startLocation = urlencode($startMain);
	$endLocation = end($stops);
	
	$waypoints = "";
	foreach($stops as $stop){
		if($stop != $startLocation && $stop != $endLocation){
			if($waypoints != ""){
				$waypoints .= "|";
			}
			$waypoints .= $stop;
		}
	}
	$endLocation = urlencode($endLocation);
	
	$waypoints = urlencode($waypoints);
	
	$maplink = "https://www.google.com/maps/dir/?api=1&origin=$startLocation&destination=$endLocation&waypoints=$waypoints&travelmode=driving&dir_action=navigate";
	
	return $maplink;
}

function get_next_stop(){
	global $start;
	global $locsStringExcaped;
	global $locsString;
	global $locsLeft;
	
	$startTmp = urlencode($start);
	$link = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$startTmp&destinations=$locsStringExcaped&key=AIzaSyADMgLhduup2sJHi7al5Xlyue4Hm02s12M";
//echo("<br><br>$link<br><br>");
$res = file_get_contents($link);
//echo("<br><br><br>");
//var_dump($res);
$fullres = json_decode(file_get_contents($link),true);
//echo("<br><br><br>");
//var_dump($fullres);

$res = $fullres["rows"][0]["elements"];
//echo("<br><br><br>");
//var_dump($res);
$closer = -1;
$meters = -1;

if(count($GLOBALS["addressLookup"]) == 0){
	$addresses = $fullres["destination_addresses"];
	foreach($addresses as $key=>$value){
		$GLOBALS["addressLookup"][$GLOBALS["locs"][$key]] = $value;
	}
	
	//var_dump($GLOBALS["addressLookup"]);
}

foreach($res as $key=>$loc){
	if($closer == -1){
		$closer = $key;
		$meters = $loc[$GLOBALS["careKey"]]["value"];
		$meters = $loc[$GLOBALS["careKey"]]["value"];
		//echo("First set to $closer : $meters \n<br>\n<br>");
	}
	if($loc[$GLOBALS["careKey"]]["value"] < $meters){
		$closer = $key;
		$meters = $loc[$GLOBALS["careKey"]]["value"];
		//echo("Updated to $closer : $meters \n<br>\n<br>");
	}
}
$res[$closer];
$location = $locsLeft[$closer];
array_splice($locsLeft, $closer,1);
$locsString = join("|", $locsLeft);
$GLOBALS["start"] = $location;
$GLOBALS["locsStringExcaped"] = urlencode($locsString);
return array("key"=>$closer, "loc"=> $location);
}
?>