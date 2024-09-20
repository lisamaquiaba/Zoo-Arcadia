<?php

function getLastRapportById(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM rapport_veterinaire WHERE id_animal = :id ORDER BY rapport_veterinaire_id DESC LIMIT 1');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAllRapport(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM rapport_veterinaire WHERE id_animal = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
 
function addRapport($pdo, $report, $id) {
     if (!empty($report)) {
        // Préparation de la requête d'insertion
        $query = $pdo->prepare("INSERT INTO rapport_veterinaire (detail, id_animal) VALUES (:detail, :id_animal)");
        $query->bindValue(':detail', $report, PDO::PARAM_STR);
        $query->bindValue(':id_animal', $id, PDO::PARAM_INT);

        try {
            $res = $query->execute();
            if ($res) {
                return $pdo->lastInsertId(); // Retourner l'ID du dernier enregistrement
            } else {
                return "Erreur lors de la création du compte rendu.";
            }
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    } else {
        return "Veuillez remplir tous les champs.";
    }
}


