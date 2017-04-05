<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
//Inserts a relationship between a character and a power in to the DC_Characters_Power table
if(!($stmt = $mysqli->prepare("INSERT INTO DC_Characters_Power (cId, pId) VALUES(? , ?)"))){
	echo "Prepare failed" . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$_POST['name'],$_POST['power']))){
	echo "Bind failed" . $stmt->errno . " " . $stmt->error;
}	
if(!$stmt->execute()){
	echo "Execute failed" . $stmt->errno . " " . $stmt->error;
} else{
	echo "Added " . $stmt->affected_rows. "rows to DC_Characters_Power";
}
?>