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
					//TODO the userquery is actually just in the wrong spot on this page too. fix that

					echo
						'<form>
						<label for="queryVal">Search:</label>
						<input type="text" id="queryVal" name="queryVal"><br>
						</form>'; 

					//TODO add some kind of help popup or page thing that has some basic rules of how to search

					//regex validates input
                    $allowable = 
"/^(((b|B)ug)|((d|D)ark)|((d|D)ragon)|((e|E)lectric)|((f|F)airy)|((f|F)ighting)|((f|F)ire)|((f|F)lying)|((g|G)host)|((g|G)rass)|((g|G)round)|((i|I)ce)|((n|N)ormal)|((p|P)oison)|((p|P)sychic)|((r|R)ock)|((s|S)teel)|((w|W)ater)){1}$/";
//((,| , | ,|, )((b|B)ug)|((d|D)ark)|((d|D)ragon)|((e|E)lectric)|((f|F)airy)|((f|F)ighting)|((f|F)ire)|((f|F)lying)|((g|G)host)|((g|G)rass)|((g|G)round)|((i|I)ce)|((n|N)ormal)|((p|P)oison)|((p|P)sychic)|((r|R)ock)|((s|S)teel)|((w|W)ater)){0,1}/";
					//if a query is there
					if (isset($_GET['queryVal']) && "" != $_GET['queryVal']){
						// and it is allowable
						if (preg_match($allowable, $_GET['queryVal'])){
							$userQuery = $_GET['queryVal'];
							// display the current query conditions
							echo $userQuery;
							//if only one type
							if (preg_match("/^(((b|B)ug)|((d|D)ark)|((d|D)ragon)|((e|E)lectric)|((f|F)airy)|((f|F)ighting)|((f|F)ire)|((f|F)lying)|((g|G)host)|((g|G)rass)|((g|G)round)|((i|I)ce)|((n|N)ormal)|((p|P)oison)|((p|P)sychic)|((r|R)ock)|((s|S)teel)|((w|W)ater)){1}$/", $userQuery)){
								$defQuery = "SELECT * from effectiveness where pokemonpokemonType = \"" . $userQuery . "\";";
								$userQuery = preg_replace("/((f|F)ighting)/", "fight", $userQuery);
								$offWeak = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery . " =0.5;";
								$offStrong = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery . " =2;";
								displayDataType($defQuery, $offWeak, $offStrong, 1);
							}
							/*
							else{
								$userQuery1 = preg_replace("/(( , | ,|, |,)((b|B)ug)|((d|D)ark)|((d|D)ragon)|((e|E)lectric)|((f|F)airy)|((f|F)ighting)|((f|F)ire)|((f|F)lying)|((g|G)host)|((g|G)rass)|((g|G)round)|((i|I)ce)|((n|N)ormal)|((p|P)oison)|((p|P)sychic)|((r|R)ock)|((s|S)teel)|((w|W)ater))$/", "" ,$userQuery);
								$userQuery2 = preg_replace("/^(((b|B)ug)|((d|D)ark)|((d|D)ragon)|((e|E)lectric)|((f|F)airy)|((f|F)ighting)|((f|F)ire)|((f|F)lying)|((g|G)host)|((g|G)rass)|((g|G)round)|((i|I)ce)|((n|N)ormal)|((p|P)oison)|((p|P)sychic)|((r|R)ock)|((s|S)teel)|((w|W)ater))( , | ,|, |,)/", "" ,$userQuery);
								$offWeak1 = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery1 . " =0.5;";
								$offStrong1 = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery1 . " =2;";
								$defQuery1 = "SELECT * from effectiveness where pokemonpokemonType = \"" . $userQuery1 . "\";";
								$offWeak2 = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery2 . " =0.5;";
								$offStrong2 = "SELECT pokemonpokemonType FROM effectiveness WHERE against_" . $userQuery2 . " =2;";
								$defQuery2 = "SELECT * from effectiveness where pokemonpokemonType = \"" . $userQuery2 . "\";";
								displayDataTypeTwo($defQuery1, $offWeak1, $offStrong1, $defQuery2, $offWeak2, $offStrong2);
							}
							*/
						}
						else{
							echo "invalid query";
							displayDataType(0,0,0,0);
						}
					}
					else{
						displayDataType(0,0,0,0);
					}
					

						// format as table
						function displayDataType($defQuery, $offWeak, $offStrong, $withData){

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>defensively <br> weak to</td>";
						if ($withData ==1){
							displayDataDef($defQuery, 2);
						}
						echo'</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>defensively <br> resistant to</td>";
						if ($withData ==1){
							displayDataDef($defQuery, 0.5);
						}
						echo '</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>offensively <br> weak against</td>";
						if ($withData ==1){
							displayDataOff($offWeak);
						}
						echo'</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>offensively <br> strong against</td>";
						if ($withData ==1){
							displayDataOff($offStrong);
						}
						echo '</tr></table></div>';
						}


/*
						function displayDataTypeTwo($defQuery1, $offWeak1, $offStrong1, $defQuery2, $offWeak2, $offStrong2){

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>defensively <br> weak to</td>";
						displayDataDef($defQuery1, 2);
						displayDataDef($defQuery2, 2);
						echo'</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>defensively <br> resistant to</td>";
						displayDataDef($defQuery1, 0.5);
						displayDataDef($defQuery2, 0.5);
						echo '</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>offensively <br> weak against</td>";
						displayDataOff($offWeak1);
						displayDataOff($offWeak2);
						echo'</tr></table></div>';

						echo '<div style="float: left;margin-right:10px"><table><tr>';
						echo "<td align='center' style='font-size:25px'>offensively <br> strong against</td>";
						displayDataOff($offStrong1);
						displayDataOff($offStrong2);
						echo '</tr></table></div>';
						}

						*/

						function displayDataOff($sqlquery){
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

						//display all values
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td align='center' style='font-size:25px'>$row[pokemonpokemonType]</td>";
							echo "</tr>\n";
							}
						$conn->close();
					}



					function displayDataDef($sqlquery, $two){
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

						//display all values
						while($row = $result->fetch_assoc()) {
							if($row['against_normal']==$two){echo "<tr><td align='center' style='font-size:25px'>normal</td></tr>\n";}
							if($row['against_fire']==$two){echo "<tr><td align='center' style='font-size:25px'>fire</td></tr>\n";}
							if($row['against_water']==$two){echo "<tr><td align='center' style='font-size:25px'>water</td></tr>\n";}
							if($row['against_electric']==$two){echo "<tr><td align='center' style='font-size:25px'>electric</td></tr>\n";}
							if($row['against_grass']==$two){echo "<tr><td align='center' style='font-size:25px'>grass</td></tr>\n";}
							if($row['against_ice']==$two){echo "<tr><td align='center' style='font-size:25px'>ice</td></tr>\n";}
							if($row['against_fight']==$two){echo "<tr><td align='center' style='font-size:25px'>fighting</td></tr>\n";}
							if($row['against_poison']==$two){echo "<tr><td align='center' style='font-size:25px'>poison</td></tr>\n";}
							if($row['against_ground']==$two){echo "<tr><td align='center' style='font-size:25px'>ground</td></tr>\n";}
							if($row['against_flying']==$two){echo "<tr><td align='center' style='font-size:25px'>flying</td></tr>\n";}
							if($row['against_psychic']==$two){echo "<tr><td align='center' style='font-size:25px'>psychic</td></tr>\n";}
							if($row['against_bug']==$two){echo "<tr><td align='center' style='font-size:25px'>bug</td></tr>\n";}
							if($row['against_rock']==$two){echo "<tr><td align='center' style='font-size:25px'>rock</td></tr>\n";}
							if($row['against_ghost']==$two){echo "<tr><td align='center' style='font-size:25px'>ghost</td></tr>\n";}
							if($row['against_dragon']==$two){echo "<tr><td align='center' style='font-size:25px'>dragon</td></tr>\n";}
							if($row['against_dark']==$two){echo "<tr><td align='center' style='font-size:25px'>dark</td></tr>\n";}
							if($row['against_steel']==$two){echo "<tr><td align='center' style='font-size:25px'>steel</td></tr>\n";}
							if($row['against_fairy']==$two){echo "<tr><td align='center' style='font-size:25px'>fairy</td></tr>\n";}
							}
						$conn->close();
					}


					?>
					</h1>
				</main>
	</body>
</html>