<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>
<!-- Filters the characters based on City!-->
<table>
	<tr>
		<td>DC Character</td>
	</tr>
	<tr>
		<td>First name</td>
		<td>Last name</td>
		<td>Alias</td>
		<td>City</td>
	</tr>
	
<?php
if(!($stmt = $mysqli->prepare("SELECT DC_Character.Fname, DC_Character.Lname, DC_Character.Alias, DC_City.name FROM DC_Character INNER JOIN DC_City ON DC_Character.cityId = DC_City.id WHERE DC_City.id = ?"))){
	echo "Prepare failed" . $stmt->errno . " " . $stmt->error;
}	
if(!($stmt->bind_param("i",$_POST['city']))){
	echo "Bind failed" . $stmt->errno . " " . $stmt->error;
}	
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($Fname, $Lname, $Alias, $cityId)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Lname . "\n</td>\n<td>\n" . $Alias . "\n</td>\n<td>\n" . $cityId . "\n</td>\n</tr>\n";
	}
$stmt->close();
?>
</table>
</br>

<!-- Filters the organizations based on City!-->

<table>
	<tr>
		<td>DC Organization</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>Alignment</td>
		<td>Headquater Location</td>
	</tr>
	
<?php
	if(!($stmt = $mysqli->prepare("SELECT DC_Organization.name, DC_Organization.alignment, DC_City.name FROM DC_Organization INNER JOIN DC_City ON DC_Organization.cityId = DC_City.id WHERE DC_City.id = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['city']))){
		echo "Bind failed" . $stmt->errno . " " . $stmt->error;
	}	
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($name, $alignment, $cityId)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $alignment . "\n</td>\n<td>\n" . $cityId . "\n</td>\n</tr>\n";
	}
	$stmt->close();
?>
</table>

</br>
