<!DOCTYPE html>
<style>
td {
border: 1px solid black;
}
</style>

<html lang="en">
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<meta charset= "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
			<title>Mr.Bengal's Team</title>
	</head>
		
	<body>
		<header>
			<h1>Pokemon</h1>
		</header>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<a class="navbar-brand" href="#">
				<!--<img src="snowman.png" alt="Logo" style="width:40px;"> -->
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="teambuilder.html">Team Builder</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="creators.html">Creators</a>
					</li>
				</ul>
			</div>
		</nav>
			<main>
				<div class="row">
					<div class="col-8">
					<form>
					<label for="fname">search:</label>
					<input type="text" id="fname" name="fname"><br>
					</form> 
					</div>
				</div>

					<h1>
					<?php
					$servername = "localhost";
					$username = "admin";
					$password = "workplaceready";
					$dbname = "pokemondb";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
					}

					$sql = "SELECT * FROM pokemon";
					$result = $conn->query($sql);

					//if the table is not empty
					if ($result->num_rows > 0) {
					// format as table
					echo "<div><table>";

					//add headers
					echo "<tr>";
					echo "<td align='center' style='font-size:25px'>Name</td>";
					echo "<td align='center' style='font-size:25px'>pokedex number</td>";
					echo "<td align='center' style='font-size:25px'>generation</td>";
					echo "<td align='center' style='font-size:25px'>height (m)</td>";
					echo "<td align='center' style='font-size:25px'>weight (kg)</td>";
					echo "<td align='center' style='font-size:25px'>total stat points</td>";
					echo "<td align='center' style='font-size:25px'>catch rate</td>";
					echo "<td align='center' style='font-size:25px'>percentage male</td>";
					echo "<td align='center' style='font-size:25px'>egg cycles</td>";
					echo "<td align='center' style='font-size:25px'>legendary status</td>";
					echo "</tr>\n";


					//display all values out of the table
					while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td align='center' style='font-size:25px'>$row[name]</td>";
					echo "<td align='center' style='font-size:25px'>$row[pokedex_number]</td>";
					echo "<td align='center' style='font-size:25px'>$row[generation]</td>";
					echo "<td align='center' style='font-size:25px'>$row[height_m]</td>";
					echo "<td align='center' style='font-size:25px'>$row[weight_kg]</td>";
					echo "<td align='center' style='font-size:25px'>$row[total_points]</td>";
					echo "<td align='center' style='font-size:25px'>$row[catch_rate]</td>";
					echo "<td align='center' style='font-size:25px'>$row[percentage_male]</td>";
					echo "<td align='center' style='font-size:25px'>$row[egg_cycles]</td>";
					echo "<td align='center' style='font-size:25px'>$row[legendary_status]</td>";
					echo "</tr>\n";
					}
					echo "</table></div>";
					} else {
					echo "0 results";
					}
					$conn->close();
					?>
					</h1>
				</main>
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	</body>
</html>