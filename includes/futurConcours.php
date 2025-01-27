<?php
$sql = "SELECT * FROM Concours WHERE statut = 'pas commencé';";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$concours = $stmt->fetchall(PDO::FETCH_ASSOC);
echo '<h1 class="align_center pad-top10-bottom10">Vous trouverez les différents futur concours </h1>';

echo '<div class="align_center ">';
if ($concours) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Numéro de Concours</th>';
    echo '<th>Thème</th>';
    echo '<th>Date de Début</th>';
    echo '<th>Date de Fin</th>';
    echo '<th>Statut</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($concours as $concour) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($concour['numConcours']) . '</td>';
        echo '<td>' . htmlspecialchars($concour['theme']) . '</td>';
        echo '<td>' . htmlspecialchars($concour['dateDebut']) . '</td>';
        echo '<td>' . htmlspecialchars($concour['dateFin']) . '</td>';
        echo '<td>' . htmlspecialchars($concour['statut']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

} else {
    echo "Aucun concours avec le statut 'pas commencé'.";
}
?>