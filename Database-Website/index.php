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
					<h1>
					<?php
					

					//TODO fix the formatting of the search bar, it looks terrible
					echo
						'<form>
						<label for="queryVal">search:</label>
						<input type="text" id="queryVal" name="queryVal"><br>
						</form>'; 


					//regex to check against
					$allowable = "/[hp|attack|defense|sp. attack|sp. defense|speed|total][<|>|<=|>=|=][0-9]*/";
					//if a query is there
					if (isset($_GET['queryVal']) && "" != $_GET['queryVal']){
						// and it is allowable
						if(preg_match($allowable, $_GET['queryVal'])){
							//print it
							echo $_GET['queryVal'];
							//reformat it to be searchable based on database schema

							//TODO, this always matches on special attack. that needs fixing.
							$userQuery = $_GET['queryVal'];
							if(preg_match("/[special attack][.]*/", $userQuery)){
								echo "first?";
								$userQuery = preg_replace("/[special attack]/", "special_attack", $userQuery);
							}
							elseif(preg_match("/[special defense][.]*/", $userQuery)){
								$userQuery = preg_replace("/[special defense]/", "special_dfense", $userQuery);
							}
							elseif(preg_match("/[total][.]*/", $userQuery)){
								$userQuery = preg_replace("/[total]/", "total_points", $userQuery);
							}
							$query = "SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name where " . $userQuery . ";";
							echo $userQuery;
						}
						else{
							echo "invalid query";
							//default
							$query = "SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name;";
						}
					}
					else{
						//default
						$query = "SELECT stats.name, pokedex_number, hp, attack, defense, special_attack, special_defense, speed, total_points, legendary_status FROM stats JOIN pokemon ON pokemon.name = stats.name;";
						//echo "no query entered";
					}
					

					// format as table
					echo "<div><table>";

					displayData($query);
					/* keep this around for now, Ross needs the reference
					if(!isset($_GET['queryVal']) || "" == $_GET['queryVal']):
						echo("selecting all");
					//otherwise, break on the correct query selection and display
					else:
						echo($_GET['queryVal']);
					endif;
					*/


					//TODO add pokemon type to the table

					
					//TODO organize the table so it just fills the screen and nothing more
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
						echo "<td align='center' style='font-size:25px'>Name</td>";
						//dex
						echo "<td align='center' style='font-size:25px'>pokedex #</td>";
						//hp
						echo "<td align='center' style='font-size:25px'>hit points</td>";
						//attack
						echo "<td align='center' style='font-size:25px'>attack</td>";
						//defense
						echo "<td align='center' style='font-size:25px'>defense</td>";
						//sp attack
						echo "<td align='center' style='font-size:25px'>sp. attack</td>";
						//sp def
						echo "<td align='center' style='font-size:25px'>sp. defense</td>";
						//speed
						echo "<td align='center' style='font-size:25px'>speed</td>";
						//total
						echo "<td align='center' style='font-size:25px'>total</td>";
						//legendary
						echo "<td align='center' style='font-size:25px'>legendary</td>";

						echo "</tr>\n";
						
						//TODO add in check for empty data

						//TODO make every other row of the table a different shade

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