<?php

function getAnimals(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM animal'); 
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}

function getAnimalbyId(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM animal WHERE animal_id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function addAnimal($pdo, $prenom, $etat, $description, $race, $grammage, $nourriture, $habitatId, $imgContent) {
    if (empty($prenom) || empty($etat) || empty($imgContent)) {
        return "Veuillez remplir tous les champs, y compris la photo.";
    }

    // Préparation de la requête
    $query = $pdo->prepare("INSERT INTO animal (prenom, etat, description, race, grammage, nourriture, id_habitat, picture) VALUES (:prenom, :etat, :description, :race, :grammage, :nourriture, :id_habitat, :picture)");
    
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':etat', $etat, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':race', $race, PDO::PARAM_STR);
    $query->bindValue(':nourriture', $nourriture, PDO::PARAM_STR);
    $query->bindValue(':grammage', $grammage, PDO::PARAM_STR);
    $query->bindValue(':id_habitat', $habitatId, PDO::PARAM_INT);
    $query->bindValue(':picture', $imgContent, PDO::PARAM_LOB);

    try {
        $res = $query->execute();
        return $res ? "Animal ajouté avec succès !" : "Erreur lors de l'ajout de l'animal.";
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}