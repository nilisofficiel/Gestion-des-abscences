<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Définir des variables pour afficher les messages de succès ou d'erreur
$message = '';
$erreur = '';

// Récupérer la liste des étudiants depuis la base de données
$etudiantsQuery = "SELECT id_etudiant, nom FROM etudiants";
$coursQuery = "SELECT id_cours, nom_cours FROM cours";
$resultat = mysqli_query($connexion, $etudiantsQuery);
$resultat2 =  mysqli_query($connexion, $coursQuery);
$etudiants = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
$cours = mysqli_fetch_all($resultat2, MYSQLI_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs soumises par le formulaire
    $idEtudiant = $_POST['etudiant'];
    $motif = $_POST['motif'];
    $idCours = $_POST['cours'];
    $reduireToutes = isset($_POST['reduire_toutes']) ? true : false;
    $nombreAbsences = isset($_POST['nombre_absences']) ? $_POST['nombre_absences'] : 0;

    // Vérifier le nombre total d'absences de l'étudiant
    $absencesQuery = "SELECT SUM(nombre_heures_abscences) AS totalAbsences FROM abscences WHERE id_etudiant = '$idEtudiant'";
    $resultatAbsences = mysqli_query($connexion, $absencesQuery);
    $row = mysqli_fetch_assoc($resultatAbsences);
    $nombreTotalAbsences = $row['totalAbsences'];

    if ($nombreAbsences > $nombreTotalAbsences) {
        $erreur = "Le nombre d'absences à réduire ne peut pas dépasser le total d'absences de l'étudiant.";
    } else {
        // Mettre à jour la table `abscences` avec la justification appropriée
        if ($reduireToutes) {
            // Réduire toutes les absences pour l'étudiant
            $updateQuery = "UPDATE abscences SET justification = 1 WHERE id_etudiant = '$idEtudiant'";
            mysqli_query($connexion, $updateQuery);
        } else {
            // Réduire un nombre spécifique d'absences pour l'étudiant
            $updateQuery = "UPDATE abscences SET justification = 1 WHERE id_etudiant = '$idEtudiant' LIMIT $nombreAbsences";
            mysqli_query($connexion, $updateQuery);
        }

        // Insérer les détails de justification dans la table `justification`
        $insertQuery = "INSERT INTO justification (id_etudiant, motif, nombreAbsences, id_cours) VALUES ('$idEtudiant', '$motif', '$nombreAbsences', '$idCours')";
        mysqli_query($connexion, $insertQuery);

        // Mettre à jour le nombre d'absences dans la table `abscences`
        $updateAbsencesQuery = "UPDATE abscences SET nombre_heures_abscences = totalAbsences - $nombreAbsences WHERE id_etudiant = '$idEtudiant'";
        mysqli_query($connexion, $updateAbsencesQuery);

        $message = "Justification enregistrée avec succès.";
    }

    // Fermer le résultat de la requête des absences
    mysqli_free_result($resultatAbsences);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Justification des absences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .message {
            color: green;
            margin-bottom: 10px;
            text-align: center;
        }

        .erreur {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        select, input[type="text"], input[type="number"], input[type="submit"] {
            margin-bottom: 10px;
            padding: 5px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="checkbox"] {
            margin-top: 5px;
        }

        .form-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Formulaire de justification</h1>

        <?php if (!empty($message)) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($erreur)) : ?>
            <div class="erreur"><?php echo $erreur; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="etudiant">Choisir l'etudiant:</label>
            <select name="etudiant" id="etudiant" required>
                <?php foreach ($etudiants as $etudiant) : ?>
                    <option value="<?php echo $etudiant['id_etudiant']; ?>"><?php echo $etudiant['nom']; ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="cours">Choisir le cours:</label>
            <select name="cours" id="id_cours" required>
                <?php foreach ($cours as $cours) : ?>
                    <option value="<?php echo $cours['id_cours']; ?>"><?php echo $cours['nom_cours']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="motif">Motif justificatif:</label>
            <input type="text" name="motif" id="motif" required><br>

            <label for="reduire_toutes">Réduire toutes les absences :</label>
            <input type="checkbox" name="reduire_toutes" id="reduire_toutes"><br>

            <label for="nombre_absences">Nombre d'absences à réduire :</label>
            <input type="number" name="nombre_absences" id="nombre_absences" min="0" max="<?php echo $nombreTotalMaxAbsences; ?>" value="0" required><br>

            <input type="submit" value="Soumettre" class="submit-button">
        </form>
        <br>
    <button><a href="index.php">Menu</a></button>
    </div>
</body>
</html>