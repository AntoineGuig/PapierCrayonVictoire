<?php include('../config/connexion.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Visualisation des dessins</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/visualisation.css" />

</head>

<body>
    <header class="header">
        <?php include '../includes/header.php';
        ?>
    </header>
    <div class="content-body">
        <p>Bienvenue sur la page de visualisation des dessins></p>

        <div class="boutons">
            <span>
                <button id="btn1" class="btn" onclick="voirMesDessins()">Mes dessins</button>
                <button id="btn2" class="btn" onclick="voirLesDessinsConcours()">Tous les dessins</button>
            </span>
        </div>
        <div class="listeMesDessins" id="listeMesDessins" style="display:none;">
            <?php
            if (!empty($_SESSION['numUtilisateur'])) {

                $sql = "SELECT * FROM dessin WHERE numCompetiteur = :idUser ORDER BY dateRemise desc;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idUser', $_SESSION['numUtilisateur']);
                $stmt->execute();
                $dessins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($dessins as $dessin) { ?>
                    <div class="dessin">
                        <img src="<?= $dessin['leDessin'] ?>" alt="dessin" class="imageDessin">
                        <p><?= $dessin['dateRemise'] ?></p>
                        <p><?= $dessin['commentaire'] ?></p>
                    </div>
            <?php }
            } else {
                $error = "Utilisateur introuvable";
            }

            ?>
        </div>


        <div class="listeConcours" id="listeConcours" style="display:none;">
            <?php
            $sql = "SELECT * FROM Concours WHERE statut = 'terminé';";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $concours = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($concours as $concour) { ?>
                <div class="btnConcours">
                    <button id="<?php echo $concour['numConcours'] ?>" onclick="afficherDessinsConcours(<?php echo $concour['numConcours'] ?>)">
                        <?php echo htmlspecialchars($concour['theme']); ?>
                    </button>
                </div>
            <?php } ?>

            <div class="listeDessinsConcours" id="listeDessinsConcours" style="display:flex;">
                <?php
                $sql = "SELECT * FROM dessin WHERE numConcours = :numConcours ORDER BY dateRemise desc;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':numConcours', $concour['numConcours']);
                $stmt->execute();
                $dessinsConcours = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($dessinsConcours as $dessinConcours) { ?>
                    <div class="dessinConcours" style="display:none;" name="<?php echo $numConcours ?>">
                        <img src="<?= $dessinConcours['leDessin'] ?>" alt="dessin" class="imageDessin">
                        <p><?= $dessinConcours['dateRemise'] ?></p>
                        <p><?= $dessinConcours['commentaire'] ?></p>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
    <footer class="footer">
        <?php include '../includes/footer.html'; ?>
    </footer>
    <script src="../assets/js/visualisation.js"></script>

</body>

</html>