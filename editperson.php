<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

//Updates a row in the DC_Character table
if(!($stmt = $mysqli->prepare("Update DC_Character SET Alias = ? WHERE Fname = ? AND Lname = ?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss", $_GET['Alias'], $_GET['Fname'], $_GET['Lname']))){
	echo "Bind failed" . $stmt->errno . " " . $stmt->error;
}	
if(!$stmt->execute()){
	echo "Execute failed" . $stmt->errno . " " . $stmt->error;
} else{
	echo "Edited " . $stmt->affected_rows. "rows to DC_Character";
}

?>