<?php
include('connexion.php');

$login = trim($_POST['login']);
$password = trim($_POST['password']);

if (!empty($login) && !empty($password)) {
    $sql = "SELECT * FROM Utilisateur WHERE login = :email;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['password']) {
        session_start();
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        echo $_SESSION['prenom'];
        //header('Location: ../PapierCrayonVictoire/pages/accueil.php');
        exit();
    } else {
        $error = "Adresse e-mail ou mot de passe incorrect.";
    }
} else {
    $error = "Veuillez remplir tous les champs.";
}
