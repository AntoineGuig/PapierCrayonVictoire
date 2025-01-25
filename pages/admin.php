<?php include('../config/connexion.php');
$nomClub = trim($_POST['nomClub']);
$adresse = trim($_POST['adresse']);
$numTelephone = trim($_POST['numTelephone']);
$nombreAdherents = trim($_POST['nombreAdherents']);
$ville = trim($_POST['ville']);
$departement = trim($_POST['departement']);
$region = trim($_POST['region']);

if (!empty($nomClub) && !empty($adresse) && !empty($numTelephone) && !empty($nombreAdherents) && !empty($ville) && !empty($departement) && !empty($region)) {
    $sql = "INSERT INTO Club(numClub, nomClub, adresse, numTelephone, nombreAdherents, ville, departement, region, dateDeCreation) VALUES
    (NULL, :nomClub, :adresse, :numTelephone, :nombreAdherents, :ville, :departement, :region, CURRENT_DATE()";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nomClub', $nomClub);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':numTelephone', $numTelephone);
    $stmt->bindParam(':nombreAdherents', $nombreAdherents);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':departement', $departement);
    $stmt->bindParam(':region', $region);
    $stmt->execute();
} else {
    $error = "Veuillez remplir tous les champs.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Visualisation des dessins</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
</head>

<body>
    <header class="header">
        <?php include '../includes/header.php'; ?>
    </header>

    <div class="content-body">
        <p>Bienvenue sur la page admin</p>
        <div id="recap-container"></div>
        <h1>Création des clubs</h1>
        <form action="" method="POST">
            <label for="nomClub">Nom du club :</label>
            <input type="text" id="nomClub" name="nomClub" required><br><br>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required><br><br>

            <label for="numTelephone">Numéro de téléphone :</label>
            <input type="text" id="numTelephone" name="numTelephone" required><br><br>

            <label for="nombreAdherents">Nombre d'adhérents :</label>
            <input type="text" id="nombreAdherents" name="nombreAdherents" required><br><br>

            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" required><br><br>

            <label for="departement">Département :</label>
            <input type="text" id="departement" name="departement" required><br><br>

            <label for="region">Région :</label>
            <input type="text" id="region" name="region" required><br><br>

            <input type="submit" value="Envoyer"><br><br>
        </form>
        <script>
            formulaireAdmin();
        </script>

    </div>
    <footer class="footer">
        <?php include '../includes/footer.html'; ?>
    </footer>
    <script src="../assets/js/admin.js"></script>
</body>

</html>