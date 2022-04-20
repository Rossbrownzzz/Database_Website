<?php
    $pdo = new PDO('sqlite:pokemonTables.db');
    $statement = $pdo->query("SELECT * from pokemon");
    $allPokemon = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo"<table border=1>";

    echo "<tr>";
        echo "<td>Title</td>";
    echo "</tr>";

    foreach($allPokemon as $row => $pokemon){
        echo "<tr>";
            echo "<td>" . $pokemon['title'] .  "</td>";
        echo "</tr>";
    }

    echo "</table>";echo "<tr>";
    echo "<td>Title</td>";
    echo "</tr>";

?>