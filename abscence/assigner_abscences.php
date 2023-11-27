<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id_etudiant = $_POST['id_etudiant'];
    $id_cours = $_POST['id_cours'];
    $nombre_heures_absences = $_POST['nombre_heures_absences'];
    //$justify = $_POST['justify'];

    // Insérer une absence dans la table "abscences"
    $sql = "INSERT INTO abscences (id_etudiant, id_cours, nombre_heures_abscences/*, justify*/) VALUES ('$id_etudiant', '$id_cours', '$nombre_heures_absences'/*, '$justify'*/)";
    if (mysqli_query($connexion, $sql)) {
        echo "L'absence a été assignée avec succès à l'étudiant.";
    } else {
        echo "Erreur lors de l'assignation de l'absence : " . mysqli_error($connexion);
    }
}

// Récupérer la liste des étudiants
$sql_etudiants = "SELECT id_etudiant, nom, prenom FROM etudiants";
$result_etudiants = mysqli_query($connexion, $sql_etudiants);

// Récupérer la liste des cours
$sql_cours = "SELECT id_cours, nom_cours FROM cours";
$result_cours = mysqli_query($connexion, $sql_cours);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assigner une absence</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        input[type="checkbox"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Assigner une absence</h1>
    <form method="POST" action="">
        <label for="id_etudiant">Étudiant :</label>
        <select name="id_etudiant" id="id_etudiant" required>
            <?php while ($row_etudiant = mysqli_fetch_assoc($result_etudiants)): ?>
                <option value="<?php echo $row_etudiant['id_etudiant']; ?>"><?php echo $row_etudiant['nom'] . ' ' . $row_etudiant['prenom']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="id_cours">Cours :</label>
        <select name="id_cours" id="id_cours" required>
            <?php while ($row_cours = mysqli_fetch_assoc($result_cours)): ?>
                <option value="<?php echo $row_cours['id_cours']; ?>"><?php echo $row_cours['nom_cours']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="nombre_heures_absences">Nombre d'heures d'absence :</label>
        <input type="number" name="nombre_heures_absences" id="nombre_heures_absences" required>

        <!-- <label for="justify">Justifié :</label>
        <input type="checkbox" name="justify" id="justify"> -->

        <input type="submit" value="Assigner l'absence">
    </form>
    <a href="liste_etudiants.php">Consulter la liste des étudiants</a>
    <a href="index.php">menu</a>
</body>
</html>