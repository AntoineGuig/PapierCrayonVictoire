<?php
$sql = "SELECT * FROM Concours WHERE statut = 'encours';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concours = $stmt->fetch(PDO::FETCH_ASSOC);

if ($concours) {
var_dump($concours);
}else{
    echo "<h1> Pas de concours en cours</h1> <br>";
}

?>