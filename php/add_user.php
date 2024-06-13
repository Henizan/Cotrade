<?php
// Inclure le fichier de connexion à la base de données
require '../includes/db_connect.php';

// Vérifier que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécuriser et récupérer le nom d'utilisateur
    $user = $conn->real_escape_string(trim($_POST['username']));

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO users (username) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);

    // Exécuter et vérifier la requête
    if ($stmt->execute()) {
        echo "Nouvel utilisateur créé avec succès";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    // Fermer la connexion et le statement
    $stmt->close();
    $conn->close();
}
?>