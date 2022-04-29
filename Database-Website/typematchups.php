<!DOCTYPE html>
<style>
form {     padding-top: 25px;     padding-bottom: 25px; }

td {
border: 1px solid black;
}

table tr:nth-child(odd) {
    background-color: #ccc;
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
			<title>Mr.Bengal's Team</title>
	</head>
	
	<body>
		<header>
			<h1>Pokemon Type Matchups</h1>
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
                        <a class="nav-link" href= "index.php">Battle Stats</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Type Matchups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eggData.php">Egg Data</a>
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


					//TODO fix the formatting of the search bar, it looks terrible, and also line "echo $userQuery;" looks terrible too.
					echo
						'<form>
						<label for="queryVal">Search:</label>
						<input type="text" id="queryVal" name="queryVal"><br>
						</form>'; 

					//TODO add some kind of help popup or page thing that has some basic rules of how to search

					//TODO allow searching - only by name or egg type for this page.
					//regex validates input

                    $allowable = 
"/.*/";
					//if a query is there
					if (isset($_GET['queryVal']) && "" != $_GET['queryVal']){
						// and it is allowable
						if (preg_match($allowable, $_GET['queryVal'])){
							$userQuery = $_GET['queryVal'];
							// display the current query conditions
							echo $userQuery;
							$query = "SELECT pokedex_number, pokemon.name, egg_cycles, percentage_male, egg_pokemonType FROM pokemon JOIN eggpokemontype2 ON eggpokemontype2.name = pokemon.name;";
						}
						else{
							echo "invalid query";
							//default if invalid
							$query = "SELECT pokedex_number, pokemon.name, egg_cycles, percentage_male, egg_pokemonType FROM pokemon JOIN eggpokemontype2 ON eggpokemontype2.name = pokemon.name;";
						}
					}
					else{
						//default
						$query = "SELECT pokedex_number, pokemon.name, egg_cycles, percentage_male, egg_pokemonType FROM pokemon JOIN eggpokemontype2 ON eggpokemontype2.name = pokemon.name;";
					}
					

					// format as table
					echo "<div><table>";

					displayData($query);


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
						echo "<td align='center' style='font-size:25px'>pokedex #</td>";
						echo "<td align='center' style='font-size:25px'>name</td>";
						echo "<td align='center' style='font-size:25px'>percent <br> male</td>";
						echo "<td align='center' style='font-size:25px'>egg <br> cycles</td>";
						echo "<td align='center' style='font-size:25px'>egg <br> type</td>";
		

						echo "</tr>\n";


						//display all values
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td align='center' style='font-size:25px'>$row[pokedex_number]</td>";
							echo "<td align='center' style='font-size:25px'>$row[name]</td>";
							echo "<td align='center' style='font-size:25px'>$row[percentage_male]</td>";
							echo "<td align='center' style='font-size:25px'>$row[egg_cycles]</td>";
							echo "<td align='center' style='font-size:25px'>$row[egg_pokemonType]</td>";
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