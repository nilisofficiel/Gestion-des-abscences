<?php
// Inclure le fichier de connexion à la base de données
include 'connexion.php';

// Récupérer les informations de l'absence
$id_etudiant = $_POST['id_etudiant'];
$date_absence = $_POST['date_absence'];
$raison_absence = $_POST['raison_absence'];

// Requête d'insertion des absences
$sql_absence = "INSERT INTO absences (id_etudiant, date_absence, raison_absence) VALUES ('$id_etudiant', '$date_absence', '$raison_absence')";

if (mysqli_query($conn, $sql_absence)) {
    echo "L'absence a été enregistrée avec succès.";
} else {
    echo "Erreur lors de l'enregistrement de l'absence : " . mysqli_error($conn);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>