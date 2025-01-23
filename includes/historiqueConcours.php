<?php
$sql = "SELECT * FROM Concours WHERE statut = 'terminé';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concours = $stmt->fetch(PDO::FETCH_ASSOC);



