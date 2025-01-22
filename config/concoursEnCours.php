<?php
$sql = "SELECT * FROM Concours WHERE statut = 'encours';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concours = $stmt->fetch(PDO::FETCH_ASSOC);