<?php
// Inclure le fichier de connexion à la base de données
include 'connexion.php';

// Votre code de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID de l'étudiant
    $id_etudiant = $_POST['id_etudiant'];

    // Récupérer le nombre d'absences de l'étudiant depuis la table "etudiants"
    $sql = "SELECT nombre_absences FROM etudiants WHERE id = $id_etudiant";
    // Exécuter la requête SQL
    // Afficher le nombre d'absences de l'étudiant
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulter le nombre d'absences d'un étudiant</title>
</head>
<body>
    <h1>Consulter le nombre d'absences d'un étudiant</h1>
    <form method="POST" action="">
        <label for="id_etudiant">ID de l'étudiant :</label>
        <input type="text" name="id_etudiant" id="id_etudiant" required><br><br>

        <input type="submit" value="Consulter">
    </form>
</body>
</html>