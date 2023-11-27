<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Sélectionner tous les cours de la table "cours"
$sql = "SELECT * FROM cours";
$resultat = mysqli_query($connexion, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des cours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #4287f5;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #4287f5;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <h1>Liste des cours</h1>
    <table>
        <tr>
            <th>Nom du cours</th>
            <th>Nombre d'heures total</th>
        </tr>
        <?php
        // Vérifier s'il y a des cours
        if (mysqli_num_rows($resultat) > 0) {
            // Parcourir les résultats de la requête et afficher les cours
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $row['nom_cours'] . "</td>";
                echo "<td>" . $row['nombre_heures_total'] . " heures</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucun cours trouvé.</td></tr>";
        }
        ?>
    </table>
    <br>
    <button><a href="index.php">Menu</a></button>
</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($connexion);
?>