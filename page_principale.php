<?php
// Connexion à la base de données
$servername = 'localhost';
$username = 'root';
$password = '';
$base = 'register_class';

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $base);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
} else {
    echo "Connection ok";
}

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $bagnards = isset($_POST['bagnards']) ? $_POST['bagnards'] : [];

    foreach($bagnards as $bagnard){
        echo $bagnard . "<br>";
    }

    // Vérifier si des bagnards ont été sélectionnés
    if (empty($bagnards)) {
        $message = "Veuillez sélectionner au moins un bagnard";
    } else {
        // Parcourir les bagnards sélectionnés
        foreach ($bagnards as $bagnard) {
            // Vérifier si le bagnard est déjà présent dans la table
            $select_stmt = $conn->prepare("SELECT * FROM learderboard WHERE bagnards = ?");
            $select_stmt->bind_param("s", $bagnard);
            $select_stmt->execute();
            $result = $select_stmt->get_result();

            if ($result->num_rows > 0) {
                // Le bagnard est déjà présent dans la table
                // Récupérer son coût actuel et l'incrémenter de 1
                $row = $result->fetch_assoc();
                $cost = $row['cost'] + 1;

                // Mettre à jour la ligne correspondante dans la table
                $update_stmt = $conn->prepare("UPDATE learderboard SET cost = ? WHERE bagnards = ?");
                $update_stmt->bind_param("is", $cost, $bagnard);
                $update_stmt->execute();
            } else {
                // Le bagnard n'est pas encore présent dans la table
                // Insérer une nouvelle ligne avec un coût de 1
                $insert_stmt = $conn->prepare("INSERT INTO learderboard (bagnards, cost) VALUES (?, 1)");
                $insert_stmt->bind_param("s", $bagnard);
                $insert_stmt->execute();
            }
        }
        
        echo "Inscription réussite";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Main_page</title>
        <link rel="stylesheet" href="page_principale.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/Mon_compte.php'";>Mon compte</button></li>
                <li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/Learderboard.php'";>Learderboard</button></li>
                <li><button onclick="window.location.href = 'http://localhost/Roulette_de_l_enfer/page_principale.php'";>Accueil</button></li>
            </ul>
        </nav>
        <!--<img src="arjel-banner.jpg" alt="Ma bannière">-->
        <h1>Roulette de L'enfer</h1>
        <h2>Cour d'informatique du <span id="date"></span></h2>

        <script>
        // Récupération de la date actuelle
        var currentDate = new Date();

        // Calcul du nombre de jours restants avant le prochain lundi ou vendredi
        var daysUntilNextMonday = 8 - currentDate.getDay();
        var daysUntilNextFriday = 12 - currentDate.getDay();

        // Vérification si la date est un lundi ou un vendredi
        if (currentDate.getDay() === 1) {
        document.getElementById("date").innerHTML = new Date().toLocaleDateString("fr-FR") + " (aujourd'hui)";
        } else if (currentDate.getDay() === 5) {
        document.getElementById("date").innerHTML = new Date().toLocaleDateString("fr-FR") + " (aujourd'hui)";
        } else {
        // Calcul de la prochaine date possible
        var nextDate = currentDate;
        if (daysUntilNextMonday <= 4) {
            nextDate.setDate(currentDate.getDate() + daysUntilNextMonday);
        } else {
            nextDate.setDate(currentDate.getDate() + daysUntilNextFriday);
        }
        // Affichage de la prochaine date possible
        document.getElementById("date").innerHTML = nextDate.toLocaleDateString("fr-FR");
        }
        </script>
        <form method="post">
        <fieldset>
            <legend>Sélection des bagnards :</legend>
                <div class="checkbox-wrapper">
                    <div class="checkbox-column">
                        <div>
                            <input type="checkbox" id="dorian" name="bagnards[]" value="Dorian">
                            <label for="dorian">Dorian</label>
                        </div>
                        <div>
                            <input type = "checkbox" id = "lou" name="bagnards[]" value="Lou" >
                            <label for="Lou">Lou</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "Hugo" name="bagnards[]" value="Hugo" >
                            <label for="Hugo">Hugo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Matthieu" >
                            <label for="Matthieu">Matthieu</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Theodule" >
                            <label for="Theodule">Théodule</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Quentin" >
                            <label for="Quentin">Quentin</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Enzo" >
                            <label for="Enzo">Enzo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Zineddine" >
                            <label for="Zineddine">Zineddine</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Maxime" >
                            <label for="Maxime">Maxime</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Adrien" >
                            <label for="Adrien">Adrien</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Zyad" >
                            <label for="Zyad">Zyad</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Matteo" >
                            <label for="Matteo">Mattéo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Luc" >
                            <label for="Luc">Luc</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Prosper" >
                            <label for="Prosper">Prosper</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Matheo" >
                            <label for="Matheo">Mathéo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Thomas" >
                            <label for="Thomas">Thomas</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Justin" >
                            <label for="Justin">Justin</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Gurvan" >
                            <label for="Gurvan">Gurvan</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Lucas" >
                            <label for="Lucas">Lucas.Z</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Samuel" >
                            <label for="Samuel">Samuel</label>
                        </div>
                    </div>
                    <div class="checkbox-column"> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Lilian" >
                            <label for="Lilian">Lilian</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Albin" >
                            <label for="Albin">Albin</label>
                        </div>
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Elsa" >
                            <label for="Elsa">Elsa</label>
                        </div>  
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Raphael" >
                                <label for="Raphael">Raphaël</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Théophile" >
                            <label for="Théophile">Théophile</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Thimotee" >
                            <label for="Thimotee">Thimotée</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Tim" >
                            <label for="Tim">Tim</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Pierrick" >
                            <label for="Pierrick">Pierrick</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Tom" >
                            <label for="Tom">Tom</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Lorenzo" >
                            <label for="Lorenzo">Lorenzo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Adam" >
                            <label for="Adam">Adam</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Leopold" >
                            <label for="Leopold">Léopold</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Romain" >
                            <label for="Romain">Romain.G</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Lucas.G" >
                            <label for="Lucas.G">Lucas.G</label>
                        </div>
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Victor" >
                            <label for="Victor">Victor</label>
                        </div>  
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Manolo" >
                            <label for="Manolo">Manolo</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "bagnards" name="bagnards[]" value="Baptiste" >
                            <label for="Baptiste">Baptiste</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "alexis" name="bagnards[]" value="Alexis" >
                            <label for="Alexis">Alexis</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "romain" name="bagnards[]" value="Romain.B" >
                            <label for="Romain.B">Romain.B</label>
                        </div> 
                        <div>
                            <input type = "checkbox" id = "louis" name="bagnards[]" value="Louis" >
                            <label for="Louis">Louis</label>
                        </div> 
                    </div>
                </div>                   
            </fieldset>
            <input type="submit" name="submit" value="Envoyer">
        </form>
        <script>
            var form = document.querySelector('form');
            var checkboxes = document.querySelectorAll('input[type=checkbox][name="bagnards[]"]');
            var limit = 3;
            var checkedCount = 0;

            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', function() {
                    checkedCount = document.querySelectorAll('input[type=checkbox][name="bagnards[]"]:checked').length;
                    if (checkedCount > limit) {
                        alert('Vous ne pouvez sélectionner que 3 personnes');
                        this.checked = false;
                    }
                });
            }

            form.addEventListener('submit', function(event) {
                checkedCount = document.querySelectorAll('input[type=checkbox][name="bagnards[]"]:checked').length;
                if (checkedCount !== limit) {
                    event.preventDefault();
                    alert('Veuillez sélectionner exactement 3 personnes');
                }
            });
        </script>
    </body>
</html>
