<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","mcintost-db","k6igyWcKKolZpTrS","mcintost-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<html>
<body>

<!--Displays the DC_Character table !-->

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
	if(!($stmt = $mysqli->prepare("SELECT DC_Character.Fname, DC_Character.Lname, DC_Character.Alias, DC_City.name FROM DC_Character INNER JOIN DC_City ON DC_Character.cityId = DC_City.id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
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

<!--Displays the DC_City table !-->

<table>
	<tr>
		<td>DC City</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>Population</td>
		<td>Country</td>
	</tr>
	
<?php
	if(!($stmt = $mysqli->prepare("SELECT name, population, country FROM DC_City"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($name, $population, $country)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $population . "\n</td>\n<td>\n" . $country . "\n</td>\n</tr>\n";
	}
	$stmt->close();
?>
</table>
</br>

<!--Displays the DC_Organization table !-->

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
	if(!($stmt = $mysqli->prepare("SELECT DC_Organization.name, DC_Organization.alignment, DC_City.name FROM DC_Organization INNER JOIN DC_City ON DC_Organization.cityId = DC_City.id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
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

<!--Displays the DC_Power_Ability table !-->

<table>
	<tr>
		<td>DC Powers and Abilities</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>Origin</td>
	</tr>
	
<?php
	if(!($stmt = $mysqli->prepare("SELECT name, origin FROM DC_Power_Ability"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($name, $origin)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $origin . "\n</td>\n</tr>\n";
	}
	$stmt->close();
?>
</table>
</br>

<!--Displays the DC_Characters_Organization table !-->

<table>
	<tr>
		<td>DC Characters Organization Membership</td>
	</tr>
	<tr>
		<td>Alias</td>
		<td>Organization</td>
	</tr>
	
<?php
	if(!($stmt = $mysqli->prepare("SELECT chart.Alias, org.name AS chartorg FROM DC_Character AS chart LEFT JOIN DC_Characters_Organization AS corg ON chart.id = corg.cid LEFT JOIN DC_Organization AS org ON corg.oid = org.id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($Alias,  $name)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $Alias . "\n</td>\n<td>\n"  . $name . "\n</td>\n</tr>\n";
	}
	$stmt->close();
?>
</table>
</br>

<!--Displays the DC_Characters_Power table !-->

<table>
	<tr>
		<td>DC Characters Powers and Abilities</td>
	</tr>
	<tr>
		<td>Alias</td>
		<td>Power</td>
	</tr>
	
<?php
	if(!($stmt = $mysqli->prepare("SELECT chart.Alias, pow.name AS cp FROM DC_Character AS chart LEFT JOIN DC_Characters_Power AS cp ON chart.id = cp.cid LEFT JOIN DC_Power_Ability AS pow ON cp.pid = pow.id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($Alias,  $name)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while ($stmt->fetch()){
		echo "<tr>\n<td>\n" . $Alias . "\n</td>\n<td>\n"  . $name . "\n</td>\n</tr>\n";
	}
	$stmt->close();
?>
</table>
</br>


<!--Filters the DC_Character and DC_Organization tables by city !-->

<div>
	<form method="post" action="filter.php">
		<fieldset>
			<legend> Filter by City </legend>
				<select name="city">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, name FROM DC_City"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
				?>
				</select>	
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
	
</div>
</br>

<!--Adds a row into the DC_Character table !-->

<table>
	<tr>
		<td>Add DC Character</td>
	</tr>
</table>	

	<div>
		<form method="post" action="addperson.php">

			<fieldset>
				<legend>Add Name</legend>
				<p>First name: </p> <input type="text" name="Fname" /></p>
				<p>Last name: </p> <input type="text" name="Lname" /></p>
			</fieldset>

			<fieldset>
				<legend>Alias</legend>
				<p>Alias: </p> <input type="text" name="Alias" /></p>
			</fieldset>

			<fieldset>
			<legend> Home City </legend>
			<select name="City">
			
<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM DC_City"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>		
			<p><input type="submit" name="Add" value=Add "DC_Character" /></p>	
		</form>
	</div>
	

<!--Adds a row into the DC_City table !-->
	
<table>
	<tr>
		<td>Add DC City</td>
	</tr>
</table>		

	<div>
		<form method="post" action="addcity.php">
			<fieldset>
				<legend>Name</legend>
				<p>City name: </p> <input type="text" name="name" /></p>
			</fieldset>
			<fieldset>
				<legend>City Population</legend>
				<p>Population: </p> <input type="text" name="population" /></p>
			</fieldset>
			<fieldset>
				<legend>Country</legend>
				<p>Country city is located in: </p> <input type="text" name="country" /></p>
			</fieldset>
			<p><input type="submit" name="Add" value=Add "DC_City" /></p>
		</form>
	</div>

<!--Adds a row into the DC_Organization table !-->
	
<table>
	<tr>
		<td>Add DC Organization</td>
	</tr>
</table>	

	<div>
		<form method="post" action="addorganization.php">
			<fieldset>
				<legend> Name</legend>
				<p>Organization name: </p> <input type="text" name="name" /></p>
			</fieldset>
			<fieldset>
				<legend> Alignment</legend>
				<p>Alignment: </p> <input type="text" name="alignment" /></p>
			</fieldset>
				<fieldset>
			<legend> Home City </legend>
			<select name="city">
				<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM DC_City"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>
			<p><input type="submit" name="Add" value=Add "DC_Organization" /></p>
		</form>
	</div>
	
<!--Adds a row into the DC_Power_Ability table !-->	
	
<table>
	<tr>
		<td>Add DC Power or Ability</td>
	</tr>
</table>	
	
	<div>
		<form method="post" action="addpower.php">
			<fieldset>
				<legend>Name</legend>
				<p>Power or Ability name: </p> <input type="text" name="name" /></p>
			</fieldset>
			<fieldset>
				<legend>Origin of the power or ability</legend>
				<p>Origin: </p> <input type="text" name="origin" /></p>
			</fieldset>
			<p><input type="submit" name="Add" value=Add "DC_Power_Ability" /></p>
		</form>
	</div>

<!--Adds a row into the DC_Characters_Organization table !-->
	
<table>
	<tr>
		<td>Add Character Membership to Organization</td>
	</tr>
</table>	
	
	<div>
		<form method="post" action="addperson_org.php">
			<fieldset>
				<legend>Name</legend>
			<select name="name">		
<?php
	if(!($stmt = $mysqli->prepare("SELECT id, Alias FROM DC_Character"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>
			
			<fieldset>
				<legend>Organization</legend>
			<select name="organization">
			
<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM DC_Organization"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>
			<p><input type="submit" name="Add" value=Add "DC_Power_Ability" /></p>
		</form>
	</div>	
	
<!--Adds a row into the DC_Characters_Power table !-->	
	
<table>
	<tr>
		<td>Add Character Ability or Power</td>
	</tr>
</table>	
	
	<div>
		<form method="post" action="addperson_ability.php">
			<fieldset>
				<legend>Name</legend>
			<select name="name">		
<?php
	if(!($stmt = $mysqli->prepare("SELECT id, Alias FROM DC_Character"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>
			
			<fieldset>
				<legend>Power or Ability</legend>
			<select name="power">
			
<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM DC_Power_Ability"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
?>
			</select>
			</fieldset>
			<p><input type="submit" name="Add" value=Add "DC_Power_Ability" /></p>
		</form>
	</div>		
	
<!--Updates a row in the DC_Character table !-->	
	
	
<table>
	<tr>
		<td>Update DC Character Alias</td>
	</tr>
</table>	

	<div>
		<form method="get" action="editperson.php">

			<fieldset>
				<legend>Name</legend>
				<p>First name: </p> <input type="text" name="Fname" /></p>
				<p>Last name: </p> <input type="text" name="Lname" /></p>
			</fieldset>

		<fieldset>
				<legend>Alias</legend>
				<p>Alias: </p> <input type="text" name="Alias" /></p>
			</fieldset>
			
		<p><input type="submit" name="Edit" value=Update "DC_Character" /></p>	
	
</body>
</html>





