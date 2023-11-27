<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $classe = $_POST['classe'];

    // Insérer un étudiant dans la table "etudiants"
    $sql = "INSERT INTO etudiants (nom, prenom, email, classe) VALUES ('$nom', '$prenom', '$email', '$classe')";
    if (mysqli_query($connexion, $sql)) {
        echo "L'étudiant a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'étudiant : " . mysqli_error($connexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un étudiant</title>
    <style>
        body {
            text-align: center;
            background-color: #f2f2f2; /* Couleur de fond */
        }
        h1 {
            color: #4287f5; /* Couleur du titre */
        }
        form {
            display: inline-block;
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #4287f5; /* Couleur des labels */
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #4287f5; /* Couleur des bordures */
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4287f5; /* Couleur du bouton */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #4287f5; /* Couleur des liens */
        }
    </style>
</head>
<body>
    <h1>Ajouter un étudiant</h1>
    <form method="POST" action="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br><br>

        <label for="email">Email :</label>
        <input type="text" name="email" id="email" required><br><br>

        <label for="classe">Classe :</label>
        <select name="classe" id="classe" required>
            <option value="6iem">6iem</option>
            <option value="5iem">5iem</option>
            <option value="4iem">4iem</option>
            <option value="3iem">3iem</option>
            <option value="2nd">2nd</option>
            <option value="premiere">Première</option>
            <option value="terminale">Terminale</option>
        </select><br><br>
        <input type="submit" value="Ajouter l'étudiant">
    </form>
    <a href="liste_etudiants.php">Consulter la liste des étudiants</a>
    <a href="index.php">Menu</a>
</body>
</html>