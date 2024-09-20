<?php

function getAvisVisible(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM avis WHERE isVisible = 1'); 
    $query->execute(); 
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function getAllAvis(PDO $pdo) {
    $query = $pdo->prepare('SELECT * FROM avis'); 
    $query->execute(); 
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function createAvis($pdo, $pseudo, $comment) {
    if (!empty($pseudo) && !empty($comment)) {
        $query = $pdo->prepare("INSERT INTO avis (pseudo, comment) VALUES (:pseudo, :comment)");
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':comment', $comment, PDO::PARAM_STR);

        try {
            $res = $query->execute();
            if ($res) {
                return $pdo->lastInsertId();
            } else {
                return "Erreur lors de l'ajout du commentaire.";
            }
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    } else {
        return "Veuillez remplir tous les champs.";
    }
}


function updateAprouvedAvis($pdo, $isVisible, $idAvis) {
    $query = $pdo->prepare('UPDATE avis SET isVisible = :isVisible WHERE id = :id');
    $query->execute([
        'isVisible' => $isVisible,
        'id' => $idAvis
    ]);
}