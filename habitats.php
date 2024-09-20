
    <?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/habitat.php";

    $isAdminOnly = false;

    if (isset($user['role']) && $user['role'] === 'admin' ) {
      $isAdminOnly = true;
    }

    $listHabitats = getHabitats($pdo) 
    
    ?>
    <div class="bar">
      <h1>Leurs habitats</h1>
      <p>
        Au zoo Arcadia, il est essentiel pour nous que nos animaux se sentent
        épanouis et comme chez eux. C’est pour cela que nous avons mis un point
        d’honneur à recréer leurs habitats naturels dans le seul but qu’ils se
        sentent comme chez eux et dans un environnement confortable. Décrouvrez
        ici leurs habitats.
      </p>
    </div>

    <div>
      <?php if ($isAdminOnly): ?>
      <!-- <p>Je suis un admin ou un employe</p> -->
      <?php endif; ?>
    </div>

    <div class="container">
    <?php foreach ($listHabitats as $habitats): ?>
    
      <div class="img-card">
        <!-- <img class="img-res" src="img/jungle.png" alt="Image de la jungle" /> -->
        <?php if (!empty($habitats['picture'])): ?>
                    <!-- Affichage de l'image en base64 -->
                    <img class="img-res" src="data:image/jpeg;base64,<?= base64_encode($habitats['picture']); ?>" alt="Photo de <?= htmlspecialchars($habitats['nom']); ?>" />
                <?php else: ?>
                    <!-- Image par défaut si aucune image n'est disponible dans la base de données -->
                    <img class="img-res" src="img/default_animal.png" alt="Image par défaut" />
                <?php endif; ?>      
        <div class="card">
        <a
      href="jungle.php?id=<?=$habitats['habitat_id'] ?>"
      ><h2><?= htmlspecialchars($habitats['nom']); ?></h2>
    </a>
          
        </div>
      </div>
    <?php endforeach; ?>

    </div>

    

    <?php require_once __DIR__. "/templates/footer.php" ?>
