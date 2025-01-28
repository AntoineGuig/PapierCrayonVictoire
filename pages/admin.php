<head>
    <meta charset="UTF-8">
    <title>Administration concours</title>
    <link rel="stylesheet" href="../assets/css/admin.css"/>
</head>

<body>
<header class="header">
    <?php include '../includes/header.php'; ?>
</header>

<div class="content-body align_center">
    <p>Bienvenue sur la page admin</p>
    <div id="recap-container"></div>
    <h1>Création des concours</h1>
    <form action="creerConcours.php" method="POST">
        <label for="theme">Thème :</label>
        <input type="text" name="theme" required><br><br>

        <label for="dateDebut">Date début concours :</label>
        <input type="date" name="dateDebut" required><br><br>

        <label for="dateFin">Date fin concours :</label>
        <input type="date" name="dateFin" required/>
        <br><br>
        <input type="submit" value="Envoyer"><br><br>
    </form>


</div>
<footer class="footer">
    <?php include '../includes/footer.html'; ?>
</footer>
</body>

</html>