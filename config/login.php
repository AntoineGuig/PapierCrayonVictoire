<?php
global $pdo;
include('connexion.php');

$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));

if (!empty($login) && !empty($password)) {
    $sql = "SELECT * FROM Utilisateur WHERE login = :email;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['motDePasse']) {
        session_start();
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        header('Location: ../pages/accueil.php');
        exit();
    } else {
        $error = "Adresse e-mail ou mot de passe incorrect.";
    }
} else {
    $error = "Veuillez remplir tous les champs.";
}
?>