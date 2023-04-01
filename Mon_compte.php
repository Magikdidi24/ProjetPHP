<?php
session_start();
if (isset($_POST['logout'])) {
  // Supprimer les variables de session
  session_unset();
  // Détruire la session
  session_destroy();
  // Rediriger l'utilisateur vers la page de connexion ou la page d'accueil
  header('Location: connexion.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
    <link rel = "stylesheet" href="Mon_compte.css"></link>
</head>
<body>
    <header>
        <h1>Bienvenue sur votre Compte</h1>
        <nav>
            <ul>
                <li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/page_principale.php'";>Accueil</button></li>
                <li><form method="post">
                <button type="submit" name="logout">Déconnexion</button>
</form></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Mon profil</h2>
        <?php
        ?>
        <!--<p>Pseudo : <span class="pseudo"><?php echo $pseudo; ?></span></p>-->
    </main>
</body>
</html>
