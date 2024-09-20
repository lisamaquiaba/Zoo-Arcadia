<?php

function verifyUserLoginPassword(PDO $pdo, string $username, string $password):bool|array
{
    $query = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->execute();
    //fetch() nous permet de récupérer une seule ligne
    $user = $query->fetch(PDO::FETCH_ASSOC);

    var_dump($user);

    if ($user && password_verify($password, $user['password'])) {
        // verif ok
        return $user;
    } else {
        return false;
    }

}

function getUserById(PDO $pdo, int $id) {
    $query = $pdo->prepare('SELECT * FROM user WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

function addUser(PDO $pdo, $prenom, $name, $username, $password, $role) {
    if(!empty($prenom) && !empty($name) && !empty($username) && !empty($password) && !empty($role)) {
        try {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Préparation de la requête d'insertion
            $query = $pdo->prepare("INSERT INTO user (prenom, name, username, password, role) VALUES (:prenom, :name, :username, :password, :role)");
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':username', $username, PDO::PARAM_STR);
            $query->bindValue(':password', $hashedPassword, PDO::PARAM_STR); // On stocke le mot de passe haché
            $query->bindValue(':role', $role, PDO::PARAM_STR);

            $res = $query->execute();

            if ($res) {
                return "Compte créé avec succès. ";
            } else {
                return  "Erreur lors de la création du compte.";
            }
        } catch (PDOException $e) {
            return  "Erreur SQL : " . $e->getMessage();
        }
    } else {
        return "Veuillez remplir tous les champs.";
    }
}