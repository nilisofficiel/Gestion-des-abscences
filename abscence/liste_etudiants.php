<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .titre {
            color: green;
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #4287f5;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4287f5;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #eaf2ff;
        }

        tr:hover {
            background-color: #ffdb99;
            color: #fff;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4287f5;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    // Inclure le fichier de connexion à la base de données
    require_once 'connexion.php';

    // Vérifier la connexion à la base de données
    if (!$connexion) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Récupérer la liste des étudiants
    $sql_etudiants = "SELECT id_etudiant, nom, prenom, email, classe FROM etudiants";
    $result_etudiants = mysqli_query($connexion, $sql_etudiants);

    // Vérifier si la requête a abouti
    if (!$result_etudiants) {
        die("Erreur lors de la récupération des étudiants : " . mysqli_error($connexion));
    }

    // Récupérer le nombre total d'absences pour chaque étudiant
    $sql_absences = "SELECT e.id_etudiant, SUM(a.nombre_heures_abscences) AS 'nombre_absences' 
                        FROM etudiants e 
                        LEFT JOIN abscences a ON e.id_etudiant = a.id_etudiant 
                        GROUP BY e.id_etudiant";
    $result_absences = mysqli_query($connexion, $sql_absences);

    // Vérifier si la requête a abouti
    if (!$result_absences) {
        die("Erreur lors de la récupération des absences : " . mysqli_error($connexion));
    }

    // Créer un tableau associatif pour stocker les totaux d'absences par étudiant
    $totales_absences = array();
    while ($row = mysqli_fetch_assoc($result_absences)) {
        $totales_absences[$row['id_etudiant']] = $row['nombre_absences'];
    }
    ?>

    <h1 class="titre">Liste des étudiants</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Classe</th>
            <th>Nombre d'absences</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_etudiants)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_etudiant']); ?></td>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['classe']); ?></td>
                <td><?php echo isset($totales_absences[$row['id_etudiant']]) ? htmlspecialchars($totales_absences[$row['id_etudiant']]) : 0; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Menu</a>
</body>
</html>