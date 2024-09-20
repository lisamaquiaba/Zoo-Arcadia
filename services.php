<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/service.php";

    
    $listServices = getService($pdo);

    // Ajouter photos
    $isAdminOrEmployee = false;

    // Vérifier si la session utilisateur est définie avant d'accéder à ses éléments
    if (isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'employe')) {
        $isAdminOrEmployee = true;
    } 
?>

    <div class="bar">
      <h1>Nos Services</h1>
      <p>
        Au zoo Arcadia, votre plaisir fait partie de nos priorités. Pour cela,
        nous avons mis en place plusieurs services dans le but de rendre votre
        visite plus agréable et amusante. Découvrez-les juste ici !
      </p>
    </div>

    <div class="container">
       <?php foreach ($listServices as $services): ?>
         <div class="img-card">
         <?php if (!empty($services['picture'])): ?>
                    <!-- Affichage de l'image en base64 -->
                    <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($services['picture']); ?>" alt="Photo de <?= htmlspecialchars($services['nom']); ?>" />
                <?php else: ?>
                    <!-- Image par défaut si aucune image n'est disponible dans la base de données -->
                    <img class="img-res" src="img/default_animal.png" alt="Image par défaut" />
                <?php endif; ?>      
            <!-- <img class="img-res" src="img/restaurant.png" alt="Image de restaurant" /> -->
            <div class="card">
              <h2><?= htmlspecialchars($services['nom']); ?></h2>
              <p><?= htmlspecialchars($services['description']); ?></p>
            </div>
         </div>
       <?php endforeach; ?>
    </div>

    <?php require_once __DIR__. "/templates/footer.php" ?>
