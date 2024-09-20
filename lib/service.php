<?php

function getService(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM services'); 
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}