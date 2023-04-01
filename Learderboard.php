<?php
// Connexion à la base de données
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'register_class';
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données de la base de données
$sql = "SELECT bagnards, cost FROM learderboard ORDER BY cost DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Main_page</title>
    <link rel="stylesheet" href="Learderboard.css">
</head>
<body>
<li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/Mon_compte.php'";>Mon compte</button></li>
<li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/page_principale.php'";>Accueil</button></li>
	<h1>Leaderboard</h1>

	<table>
		<tr>
			<th>Position</th>
			<th>Bagnards</th>
			<th>Nb de votes</th>
		</tr>
		<?php
		// Affichage des données dans le tableau
		if ($result->num_rows > 0) {
			$position = 1;
		    while($row = $result->fetch_assoc()) {
		        echo "<tr>";
		        echo "<td>" . $position . "</td>";
		        echo "<td>" . $row["bagnards"] . "</td>";
		        echo "<td>" . $row["cost"] . "</td>";
		        echo "</tr>";
		        $position++;
		    }
		} else {
		    echo "<tr><td colspan='3'>0 results</td></tr>";
		}

		// Fermeture de la connexion à la base de données
		$conn->close();
		?>
	</table>
</body>
</html>
