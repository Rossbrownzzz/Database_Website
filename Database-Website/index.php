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
					<form method="get">
					<label for="queryVal">search:</label>
					<input type="text" id="queryVal" name="queryVal"><br>
					</form> 
					</div>
				</div>

					<h1>
					<?php
					
					//TODO organize the table so it just fills the screen and nothing more

					// format as table
					echo "<div><table>";


					if(!isset($_GET['queryVal']) || "" == $_GET['queryVal']):
						echo("selecting all");
					//otherwise, break on the correct query selection and display
					else:
						echo($_GET['queryVal']);
					endif;


					
					//TODO fill in more (modular) queries

					//default, loads all values and displays them
					$filteredQuery = $_GET['queryVal'];
					if(!isset($_GET['queryVal']) || "" == $_GET['queryVal']):
						displayData("SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name;");
					//otherwise, break on the correct query selection and display
					elseif (preg_match("/abc/", $filteredQuery)):
						displayData("SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name WHERE total_points>590 ORDER BY total_points;");
					else:
						displayData("SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name;");
					endif;


					function displayData($sqlquery){
						//establish connection
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}

						//query the bale
						$result = $conn->query($sqlquery);

						//display all headers
						echo "<tr>";
						//name
						echo "<td align='center' style='font-size:25px'>Name 
								<form method='get'>
								<input type='text' id='nameQuery' name='nameQuery'><br>
								</form> 
								</td>";
						//dex
						echo "<td align='center' style='font-size:25px'>pokedex #
								<form method='get'>
								<input type='text' id='dexQuery' name='dexQuery'><br>
								</form> 
								</td>";
						//hp
						echo "<td align='center' style='font-size:25px'>hit points
								<form method='get'>
								<input type='text' id='hpQuery' name='hpQuery'><br>
								</form> 
								</td>";
						//attack
						echo "<td align='center' style='font-size:25px'>attack
								<form method='get'>
								<input type='text' id='attackQuery' name='attackQuery'><br>
								</form> 
								</td>";
						//defense
						echo "<td align='center' style='font-size:25px'>defense
								<form method='get'>
								<input type='text' id='defenseQuery' name='defenseQuery'><br>
								</form> 
								</td>";
						//sp attack
						echo "<td align='center' style='font-size:25px'>sp. attack
								<form method='get'>
								<input type='text' id='spattackQuery' name='spattackQuery'><br>
								</form> 
								</td>";
						//sp def
						echo "<td align='center' style='font-size:25px'>sp. defense
								<form method='get'>
								<input type='text' id='spdefQuery' name='spdefQuery'><br>
								</form> 
								</td>";
						//speed
						echo "<td align='center' style='font-size:25px'>speed
								<form method='get'>
								<input type='text' id='speQuery' name='speQuery'><br>
								</form> 
								</td>";
						//total
						echo "<td align='center' style='font-size:25px'>total stats
								<form method='get'>
								<input type='text' id='totalQuery' name='totalQuery'><br>
								</form> 
								</td>";
						//legendary
						echo "<td align='center' style='font-size:25px'>legendary
								<form method='get'>
								<input type='text' id='legendaryQuery' name='legendaryQuery'><br>
								</form> 
								</td>";

						echo "</tr>\n";
						
						//TODO add in check for empty data
						
						//display all values
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td align='center' style='font-size:25px'>$row[name]</td>";
							echo "<td align='center' style='font-size:25px'>$row[pokedex_number]</td>";
							echo "<td align='center' style='font-size:25px'>$row[hp]</td>";
							echo "<td align='center' style='font-size:25px'>$row[attack]</td>";
							echo "<td align='center' style='font-size:25px'>$row[defense]</td>";
							echo "<td align='center' style='font-size:25px'>$row[special_attack]</td>";
							echo "<td align='center' style='font-size:25px'>$row[special_defense]</td>";
							echo "<td align='center' style='font-size:25px'>$row[speed]</td>";
							echo "<td align='center' style='font-size:25px'>$row[total_points]</td>";
							echo "<td align='center' style='font-size:25px'>$row[legendary_status]</td>";
							echo "</tr>\n";
							}
						echo "</table></div>";
						$conn->close();
					}

					?>
					</h1>
				</main>
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	</body>
</html>