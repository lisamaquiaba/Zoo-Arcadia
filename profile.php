<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/user.php";

    $isAdminOnly = false;
    $isVet = false;
    $isEmploye = false;


    if(isset($_GET['id'])) { 
      $id = intval($_GET['id']);
    }

    $user = getUserById($pdo, $id);

    if($_SESSION['user']['id'] !== $id) {
        header('location: index.php');
        exit;
    }

    
    if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe' && $_SESSION['user']['role'] !== 'veterinaire') {
        header('location: index.php');
        exit;
    }

    if (isset($user['role']) && $user['role'] === 'admin' ) {
        $isAdminOnly = true;
    }

    if (isset($user['role']) && $user['role'] === 'veterinaire') {
        $isVet = true;
    }

    if (isset($user['role']) && $user['role'] === 'employe') {
        $isEmploye = true;
    }

?>

    <div class="bar">
    <h2>Bienvenue <?= htmlspecialchars($user['prenom']) ?> ! </h2>
    </div>

    <div>
    <?php if ($isAdminOnly): ?>
                    <!-- <p>Je suis un admin ou un employe</p> -->
                    <a class="profile" href="addUser.php">Ajouter un utilisateur</a>
                    <a class="profile" href="addAnimal.php">Ajouter un animal</a>
                    <a class="profile" href="addHabitat.php">Ajouter un habitat</a>
                    <a class="profile" href="servicesAdmin.php">Ajouter/Modifier un service</a>
                    <a class="profile" href="addUser.php">Créer un compte</a>
                    <a class="profile" href="horaire.php">Horaires</a>
                <?php endif; ?>

                <?php if ($isVet): ?>
                    <!-- <p>Je suis un admin ou un employe</p> -->
                    <a class="profile" href="listAnimal.php">Les animaux</a>
                <?php endif; ?>

                <?php if ($isEmploye): ?>
                    <!-- <p>Je suis un admin ou un employe</p> -->
                    <a class="profile" href="servicesAdmin.php">Ajouter/Modifier un service</a>
                    <a class="profile" href="verification.php">Vérification Avis</a>
                <?php endif; ?>
    </div>
   
    <?php require_once __DIR__. "/templates/footer.php" ?>