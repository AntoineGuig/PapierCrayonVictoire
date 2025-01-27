<head>
    <meta charset="UTF-8">
    <title>Visualisation des dessins</title>
    <link rel="stylesheet" href="../assets/css/depotDessin.css" />

</head>

<body>
    <header class="header">
        <?php include '../includes/header.php'; ?>
    </header>
    <div class="content-body">
        <H1 class="mrg-top15-bottom10">Bienvenue sur la page de dépot de dessins</H1>

        <div class="formulaireAjout">
            <form action="envoieDessin.php" method="POST" enctype="multipart/form-data">
                <label for="commentaire">Commentaire :</label><br>
                <textarea class="textArea" name="commentaire" required></textarea><br><br>
                <label for="dessin">Le dessin :</label>
                <input type="file" accept=".png,.jpeg,.svg" name="dessin" required><br><br>
                <input class="btnEnvoie" type="submit" value="Envoyer"><br><br>
            </form>
        </div>
    </div>
    <footer class="footer">
        <?php include '../includes/footer.html'; ?>
    </footer>
</body>