<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Définir les variables pour stocker les données du formulaire
$nom_cours = '';
$nombre_heures_total = '';

// Récupérer la liste des cours depuis la base de données
$sql = "SELECT id_cours, nom_cours FROM cours";
$resultat = mysqli_query($connexion, $sql);
$cours = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom_cours = $_POST['nom_cours'];
    $nombre_heures_total = $_POST['nombre_heures_total'];

    // Insérer un nouveau cours dans la table "cours"
    $sql = "INSERT INTO cours (nom_cours, nombre_heures_total) VALUES ('$nom_cours', '$nombre_heures_total')";
    if (mysqli_query($connexion, $sql)) {
        echo "Le cours a été créé avec succès.";
    } else {
        echo "Erreur lors de la création du cours : " . mysqli_error($connexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un cours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #4287f5;
            text-align: center;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4287f5;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1d5bbf;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4287f5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Créer un cours</h1>
    <form method="POST" action="">
        <label for="nom_cours">Nom du cours :</label>
        <input type="text" name="nom_cours" id="nom_cours" value="<?php echo $nom_cours; ?>" required><br><br>

        <label for="nombre_heures_total">Nombre d'heures total :</label>
        <input type="number" name="nombre_heures_total" id="nombre_heures_total" value="<?php echo $nombre_heures_total; ?>" required><br><br>

        <input type="submit" value="Créer le cours">
    </form>
    <a href="liste_cours.php">Consulter la liste des cours</a>
    <a href="index.php">Menu</a>
</body>
</html>