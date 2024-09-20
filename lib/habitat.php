<?php

function getHabitats(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM habitat'); 
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}


function getHabitatById(Pdo $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM habitat WHERE habitat_id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAnimalByHabitatId(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM animal WHERE id_habitat = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}


function updateHabitat($pdo, $imgContent, $habitat, $id) {
    $query = $pdo->prepare('UPDATE habitat SET nom = :nom, description = :description, commentaire_habitat = :commentaire_habitat' . ($imgContent ? ', picture = :picture' : '') . ' WHERE habitat_id = :id');
    $params = [
        'nom' => $habitat['nom'],
        'description' => $habitat['description'],
        'commentaire_habitat' => $habitat['commentaire_habitat'],
        'id' => $id,
    ];
    if ($imgContent) {
        $params['picture'] = $imgContent; // Ajouter l'image aux paramètres
    }
   return $query->execute($params);
}