<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodingLab Navbar</title>
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/global.css">
  <script src="../assets/js/header.js"></script>
</head>
<body>
<?php
session_start();
    if (empty($_SESSION['login'])) {
        header("Location:/");
        die();
    }
    include("../config/connexion.php");
 ?>

  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="#">
          <img src="../assets/img/Logo_sans_fond.png" alt="logo">
        </a> </div>
      <div class="nav-links">
        <ul class="links">
          <li><a href="accueil.php">Accueil</a></li>
          <li>
            <a href="#">Les concours</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow'></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="concoursEnCours.php">Concours en cours</a></li>
              <li><a href="futurConcours.php">Futur concours</a></li>
              <li><a href="historiqueConcours.php">Historique des concours</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Les clubs</a>
            <i class='bx bxs-chevron-down js-arrow arrow'></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Informations clubs</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Les dessins</a>
            <i class='bx bxs-chevron-down js-arrow arrow'></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Déposer les dessins</a></li>
              <li><a href="visualisation.php">Visualiser les dessins</a></li>
            </ul>
          </li>
          <li><a href="#">A propos de nous</a></li>
        </ul>
      </div>
      <?php
      if (isset($_POST['deconnexion'])) {
        session_destroy();
        header("Location:/");
      }
      ?>
    <span class="deconnexion">
      <?php echo "<p>Bonjour ".$_SESSION['prenom']." ! </p>  <form method=\"post\"> <input type=\"submit\" name=\"deconnexion\" value=\"deconnexion\"/> </form> "
      ?>
      </span>
        <div class="admin">
          <?php
            session_start();

            // Vérifiez que la connexion PDO existe
            global $pdo;

            try {
                $sql = "SELECT login FROM utilisateur 
                        INNER JOIN administrateur 
                        ON administrateur.numAdmin = utilisateur.numUtilisateur;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            
                // Récupérez toutes les données si nécessaire
                $loginAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // Vérifiez si l'utilisateur connecté est un administrateur
                if (isset($_SESSION['login']) && $loginAdmin && $loginAdmin['login'] == $_SESSION['login']) {
                    echo "<input type='button' name='admin' value='admin'> ";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
          ?>
        </div>


        </div>

    </div>
    </div>
  </nav>
</body>
</html>