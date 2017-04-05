<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//Adds a row into the DC_Character table
if(!($stmt = $mysqli->prepare("INSERT INTO DC_Character (Fname, Lname, Alias, cityId) VALUES(?, ?, ?, ?)"))){
	echo "Prepare failed" . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sssi",$_POST['Fname'],$_POST['Lname'],$_POST['Alias'],$_POST['City']))){
	echo "Bind failed" . $stmt->errno . " " . $stmt->error;
}	
if(!$stmt->execute()){
	echo "Execute failed" . $stmt->errno . " " . $stmt->error;
} else{
	echo "Added " . $stmt->affected_rows. "rows to DC_Character";
}
?>

