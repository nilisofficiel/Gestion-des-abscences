<!DOCTYPE html>
<html>
<head>
    <title>Gestion des absences des étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .titre {
            color: #4287f5;
            text-align: center;
        }

        .marquee {
            text-align: center;
            margin: 20px 0;
        }

        button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4287f5;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button a {
            text-decoration: none;
            color: #fff;
        }

        button:hover {
            background-color: #1d5bbf;
        }
    </style>
</head>
<body>
    <h1 class="marquee">Gestion des absences des étudiants</h1>
    <br>
    <button><a href="ajouter_etudiant.php">Ajouter un étudiant</a></button>
    <br>
    <button><a href="liste_etudiants.php">Consulter la liste des étudiants</a></button>
    <br>
    <button><a href="assigner_abscences.php">Assigner des absences</a></button>
    <br>
    <button><a href="justifier_absence.php">Justifier une absence</a></button>
    <br>
    <button><a href="cours.php">Cours</a></button>
</body>
</html>