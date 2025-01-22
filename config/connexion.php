<?php
try {
    $dsn = 'mysql:host=localhost;dbname=PapierCrayonVictoire;charset=utf8';
    $username = 'db_etu';
    $password = 'N3twork!';
    //$port = '5619';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
