<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Visualisation des dessins</title>
    <link rel="stylesheet" href="../assets/css/visualisation.css" />
    <script src="../assets/js/visualisation.js"></script>

</head>

<body>
    <header class="header">
        <?php include '../includes/header.php'; ?>
    </header>
    <div class="content-body">
        <p>Bienvenue sur la page de visualisation des dessins</p>

        <div class="boutons">
            <span>
                <button id="btn1" class="btn active" onclick="voirMesDessins()">Mes dessins</button>
                <button id="btn2" class="btn" onclick="voirLesDessinsConcours()">Tous les dessins</button>
            </span>
        </div>

        <div class="listeMesDessins" id="listeMesDessins">
            <?php

            include('../config/connexion.php');

            if (!empty($_SESSION['numUtilisateur'])) {
                $sql = "SELECT Dessin.*, Concours.theme FROM Dessin inner join Concours on Concours.numConcours = Dessin.numConcours WHERE numCompetiteur = :idUser ORDER BY dateRemise DESC;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idUser', $_SESSION['numUtilisateur']);
                $stmt->execute();
                $dessins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($dessins as $dessin) { ?>
                    <div class="dessin">
                        <img src="<?= htmlspecialchars($dessin['leDessin']) ?>" alt="dessin" class="imageDessin">
                        <p><?= htmlspecialchars($dessin['theme']) ?> <?= htmlspecialchars($dessin['dateRemise']) ?></p>
                        <p><?= htmlspecialchars($dessin['commentaire']) ?></p>
                    </div>
            <?php }
            } ?>
        </div>

        <div class="listeConcours" id="listeConcours" style="display:none;">
            <?php
            $sql = "SELECT numConcours, DATE_FORMAT(dateDebut, '%d/%m/%Y') as dateDebut, DATE_FORMAT(dateFin, '%d/%m/%Y') as dateFin, theme FROM Concours WHERE statut = 'terminé' ORDER BY numConcours DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $concours = $stmt->fetchAll(PDO::FETCH_ASSOC);


            foreach ($concours as $leConcours) { ?>
                <div class="btnConcours">

                    <button class="concours-btn" data-concours="<?= htmlspecialchars($leConcours['numConcours']) ?>">
                        <?= htmlspecialchars($leConcours['theme']) . "</br>" . htmlspecialchars($leConcours['dateDebut']) . "-" . htmlspecialchars($leConcours['dateFin']) ?>
                    </button>

                    <div class="dessins-container" id="dessins-<?= htmlspecialchars($leConcours['numConcours']) ?>" style="display:none;">
                        <?php
                        $sql = "SELECT Dessin.leDessin, Dessin.commentaire, DATE_FORMAT(Dessin.dateRemise, '%d/%m/%Y') as dateRemise , Utilisateur.nom, Utilisateur.prenom FROM Dessin JOIN Utilisateur ON Dessin.numCompetiteur = Utilisateur.numUtilisateur WHERE Dessin.numConcours = :numConcours ORDER BY Dessin.dateRemise DESC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':numConcours', $leConcours['numConcours']);
                        $stmt->execute();
                        $dessinsConcours = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($dessinsConcours as $dessin) { ?>
                            <div class="dessinConcours">
                                <img src="<?= htmlspecialchars($dessin['leDessin']) ?>" alt="dessin" class="imageDessin">
                                <p>Par: <?= htmlspecialchars($dessin['prenom']) ?> <?= htmlspecialchars($dessin['nom']) ?></p>
                                <p>Date: <?= htmlspecialchars($dessin['dateRemise']) ?></p>
                                <p><?= htmlspecialchars($dessin['commentaire']) ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>

    <footer class="footer">
        <?php include '../includes/footer.html'; ?>
    </footer>

</body>

</html>