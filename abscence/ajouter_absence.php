<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id_etudiant = $_POST['id_etudiant'];
    $nombre_absences = $_POST['nombre_absences'];

    // Mettre à jour le nombre d'absences de l'étudiant dans la table "etudiants"
    $sql = "UPDATE etudiants SET nombre_absences = nombre_absences + $nombre_absences WHERE id_etudiant = $id_etudiant";
    if (mysqli_query($connexion, $sql)) {
        echo "L'absence a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'absence : " . mysqli_error($connexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une absence</title>
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
    <h1>Ajouter une absence</h1>
    <form method="POST" action="">
        <label for="id_etudiant">ID de l'étudiant :</label>
        <input type="text" name="id_etudiant" id="id_etudiant" required><br><br>

        <label for="nombre_absences">Nombre d'absences :</label>
        <input type="text" name="nombre_absences" id="nombre_absences" required><br><br>

        <input type="submit" value="Ajouter l'absence">
    </form>
    <a href="index.php">Menu</a>
</body>
</html>