<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = '';
$base = 'register_class';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Créer une connexion
  $conn = new mysqli($servername, $username, $password, $base);
  
  // Récupérer les données du formulaire
  $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
  $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
  
  var_dump($_POST['mdp']);
  echo ("\n");
  var_dump($mdp);

  // Vérifier la connexion
  if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
  }
  echo "connection ok";
  // Vérifier si le pseudo existe déjà dans la table
  $stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE pseudo = ?");
  //echo("Error description: " . $conn -> error);
  $stmt->bind_param("s", $pseudo);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo "Ce pseudo est déjà utilisé.";
  } else {
    // Insérer les données dans la table
    $stmt = $conn->prepare("INSERT INTO utilisateurs (pseudo, mdp) VALUES (?, ?)");
    $stmt->bind_param("ss", $pseudo, $mdp);
    $stmt->execute();
    echo "Inscription réussie.";
    header('Location: http://localhost/Roulette_de_l_enfer/connexion.php');

  }



  // Fermer la requête
  $stmt->close();

  // Fermer la connexion
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="main.css">

  </head>
  <body>
    <h1>Inscription</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label for="pseudo">Pseudo:</label>
      <input type="text" id="pseudo" name="pseudo" required = "required"><br>

      <label for="mdp">Mot de passe:</label>
      <input type="password" id="mdp" name="mdp" required = "required"><br>

      <input type="submit" name="submit" value="S'inscrire">
      <label for="Déja un compte ?">Déja un compte ?</label>
      <button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/connexion.php'";>Se connecter</button>
    </form>
  </body>
</html>
