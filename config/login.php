<?php
include('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (!empty($login) && !empty($password)) {
        $sql = "SELECT * FROM Utilisateur WHERE login = :login AND password = :password;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: accueil.php');
            exit();
        } else {
            $error = "Adresse e-mail ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
