<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//Adds a row into the DC_City table.
if(!($stmt = $mysqli->prepare("INSERT INTO DC_City (name, population, country) VALUES(?, ?, ?)"))){
	echo "Prepare failed" . $stmt->errno . " " . $stmt->error;
}	
if(!($stmt->bind_param("sis",$_POST['name'],$_POST['population'],$_POST['country']))){
	echo "Bind failed" . $stmt->errno . " " . $stmt->error;
}	
if(!$stmt->execute()){
	echo "Execute failed" . $stmt->errno . " " . $stmt->error;
} else{
	echo "Added " . $stmt->affected_rows. "rows to DC_City";
}
?>