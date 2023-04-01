<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = '';
$base = 'register_class';
$table = 'utilisateurs';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $base);
    // Récupérer les données du formulaire
  $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
  $mdp = $_POST['mdp'];


  // Vérifier la connexion
  if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
  }

  // Vérifier si l'utilisateur existe déjà dans la table
  $stmt = $conn->prepare("SELECT id, mdp FROM utilisateurs WHERE pseudo = ?");
  $stmt->bind_param("s", $pseudo); // == bindValues
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    // Utilisateur trouvé
    $stmt->bind_result($id, $mdp_hash);
    while ($stmt->fetch()){
        printf("mdp_hash = %s\n", $mdp_hash);
        printf("mdp = %s\n", $mdp);
    
    }
    if (password_verify($mdp, $mdp_hash)){
      // Mot de passe correct
      echo "Connexion réussie";
      // Enregistrer les informations de l'utilisateur dans la session
      session_start();
      $_SESSION['id'] = $id;
      $_SESSION['pseudo'] = $pseudo;
      // Rediriger vers la page d'accueil
      header('Location: http://localhost/Roulette_de_l_enfer/page_principale.php');
      exit();
    } else {
      // Mot de passe incorrect
      echo "Mot de passe incorrect";
    }
  } else {
    // Utilisateur non trouvé
    echo "Utilisateur non trouvé";
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
    <title>Connection</title>
    <link rel = "stylesheet" href="connexion.css"></link>
  </head>
  <body>
    <h1>Connection</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label for="pseudo">Pseudo:</label>
      <input type="text" id="pseudo" name="pseudo" required><br>

      <label for="mdp">Mot de passe:</label>
      <input type="password" id="mdp" name="mdp" required><br>

      <input type="submit" name="submit" value="Se connecter">
      <label for="Déja un compte ?">Pas de compte ?</label>
      <button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/main.php'";>S'inscrire</button>
    </form>
  </body>
</html>