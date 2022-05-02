<!DOCTYPE html>
<style>
form {     padding-top: 25px;     padding-bottom: 25px; }

td {
border: 1px solid black;
}

table tr:nth-child(odd) {
    background-color: #ccc;
}
table tr:first-child {
	background-color: #9fc5e8;
}
table {
    margin-left: auto;
    margin-right: auto;
}
</style>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<meta charset= "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
			<title>Mr.Bengal'sTeam</title>
	</head>

	<body>
		<header>
			<h1>Team Builder</h1>
		</header>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<a class="navbar-brand" href="#">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Battle Stats</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="typematchups.php">Type Matchups</a>
					</li>
					<li class="nav-item">
                        <a class="nav-link" href="eggData.php">Egg Data</a>
                    </li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Team Builder</a>
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

					//if a button is pressed
					if(array_key_exists('pokemonAdd',$_POST)){
						updateTeam($_POST['pokemonAdd']);
					}
					if(array_key_exists('deleteTeam',$_POST)){
						clearTempTeam();
					}

					//if there is any team, display it
					getTempTeam();

					//TODO fix the formatting of the search bar, it looks terrible, and also line "echo $userQuery;" looks terrible too.
					echo
						'<form>
						<label for="queryVal">Search:</label>
						<input type="text" id="queryVal" name="queryVal"><br>
						</form>'; 


					

					//TODO add some kind of help popup or page thing that has some basic rules of how to search
					$allowNameSearch = "/^(([a-z]|[A-Z]|\'|\(|\)|\-| )+)$/";

					//TODO, maybe only allow you to save it if it exists
					if (isset($_GET['saveTeam']) && "" != $_GET['saveTeam']){
						if(preg_match($allowNameSearch, $_GET['saveTeam'])){
							saveTeam($_GET['saveTeam']);
						}
						else{
							echo "your team name contains invalid characters";
						}
					}

					//if a query is there
					if (isset($_GET['queryVal']) && "" != $_GET['queryVal']){
						// and it is allowable
						if (preg_match($allowNameSearch, $_GET['queryVal'])){
							// accept the query
							$userQuery = $_GET['queryVal'];
							// display the current query conditions
							echo $userQuery;

							//construct the base query
							$query = "SELECT pokedex_number, pokemon.name FROM pokemon";
							
							$query = $query . " WHERE pokemon.name LIKE \"%" . $userQuery . "%\";";

						}
						else{
							echo "invalid query";
							//default if invalid
							$query = "SELECT pokedex_number, pokemon.name FROM pokemon;";
						}
					}
					else{
						//default
						$query = "SELECT pokedex_number, pokemon.name FROM pokemon";
					}
					
					displayData($query);

					


					/*
					on any button press, update the temporary team
					*/
					function updateTeam($pokemon) {
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						//ensure connection worked
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}

						//query the databse
						$result = $conn->query("SELECT * FROM tempTeam;");
						if ($result->num_rows >= 6){
							echo "You can't have more than six pokemon!";
						}
						else{
							$conn->query("insert into tempTeam (idx, pokemon) VALUES (1, \"$pokemon\");");
						}
					}
					
					/*
					display temprorary team
					*/
					function getTempTeam() {
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						//ensure connection worked
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}

						//query the databse
						$result = $conn->query("SELECT * FROM tempTeam");
						if ($result->num_rows == 0){}
						else{
							echo'<form method="get">
							  <label for="saveTeam">Save team as:</label>
							  <input id="saveTeam" type="text" name="saveTeam">
						  </form>';
						  

							echo "<div><table>";
							echo "<tr></tr><tr></tr><tr>";
							echo "<td align='center' style='font-size:25px'>pokemon <br> in team:</td>";
							while($row = $result->fetch_assoc()) {
								echo "<td align='center' style='font-size:25px'>$row[pokemon]</td>";
							}

							echo"<td align='center' style='font-size:25px'>
								<form method='post'>
								<button name='deleteTeam' value='deleteTeam' width='auto'>DELETE <br>TEAM</button>
								</form>
								</td>";
							echo"</tr>";

						}
					}


					/*
					delete temprorary team
					*/
					function clearTempTeam() {
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						//ensure connection worked
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}

						//query the databse
						$conn->query("DELETE FROM tempTeam");
					}

					/*
					delete temprorary team
					*/
					function saveTeam($teamName) {
						//TODO only let it save if the name is not in use
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						//ensure connection worked
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}
						
						//make sure name is not previously in use
						$nameCheck = $conn->query("SELECT * FROM savedTeams WHERE teamName = \"" . $teamName . "\";");
						if($nameCheck->num_rows != 0){
							echo "that name is already taken";
						}
						else{

						//make sure there are 6 pokemon
						$result = $conn->query("SELECT * FROM tempTeam;");
						if ($result->num_rows == 6){
							//create query and fill in pokemon
							$querytoSave = "insert into savedteams (teamName, pokemon1, pokemon2, pokemon3, pokemon4, pokemon5, pokemon6) VALUES(\"" . $teamName . "\"";
							while($row = $result->fetch_assoc()) {
								$querytoSave = $querytoSave . ", \"" . $row['pokemon'] . "\"";
							}
							$querytoSave = $querytoSave . ");";
							//save it and clear the temp team
							$conn->query($querytoSave);
							clearTempTeam();
							echo "Team saved!";
						}
						else{
							echo "please make sure you have 6 pokemon";
						}
						}
						$conn->close();
						}

					/*
					display all pokemon
					*/
					function displayData($sqlquery){
						echo "<div><table>";
						//establish connection
						$servername = "localhost";
						$username = "admin";
						$password = "workplaceready";
						$dbname = "pokemondb";
						$conn = new mysqli($servername, $username, $password, $dbname);
						
						//ensure connection worked
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
							}

						//query the databse
						$result = $conn->query($sqlquery);

						//headers
						echo "<tr>";
						//dex
						echo "<td align='center' style='font-size:25px'>pokedex #</td>";
						//name
						echo "<td align='center' style='font-size:25px'>Name</td>";
						echo "<td align='center' style='font-size:25px'>add to team</td>";

						echo "</tr>\n";

						//display all values
						//TODO add radio buttons with the id and name matching the name of the pokemon.
						while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td align='center' style='font-size:25px'>$row[pokedex_number]</td>";
								echo "<td align='center' style='font-size:25px'>$row[name]</td>";
								echo"<td align='center' style='font-size:25px'>
								<form method='post'>
								<button name='pokemonAdd' value='$row[name]' width='auto'>Add!</button>
								</form>
								</td>";
								echo "</tr>\n";
							}
							echo "</table></div>";
						$conn->close();
						}
					?>
					</h1>
				</main>
	</body>
</html>