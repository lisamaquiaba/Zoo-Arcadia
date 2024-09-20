<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/habitat.php";

    $isAdminOnly = false;

    // si on a un id dans l'url
    if(isset($_GET['id'])) {
      $id= intval($_GET['id']);
    }


    $listAnimals = getAnimalByHabitatId($pdo, $id);
    $habitats = getHabitatById($pdo, $id);

if (isset($user['role']) && $user['role'] === 'admin' ) {
  $isAdminOnly = true;
}

$imageBase64 = null;
    if (!empty($habitats['picture'])) {
        $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($habitats['picture']);
    }


?>
    <div class="container">
      <div class="explanation">     
        <?php if ($isAdminOnly): ?>
                        <!-- <p>Je suis un admin ou un employe</p> -->
                        <a class="add" href="addAnimal.php">Ajouter un animal</a>
                    <?php endif; ?>
                  </div>
      <div class="explanation">
        <div>
          <?php if ($imageBase64): ?>
                <img class="img-main" src="<?= $imageBase64 ?>" alt="Photo de <?= htmlspecialchars($habitats['nom']) ?>" />
            <?php else: ?>
                <img src="img/default.png" alt="Photo par défaut" />
            <?php endif; ?>
        </div>
        <div class="descrpition">
          <h2 class="title-accueil"><?= htmlspecialchars($habitats['nom']) ?></h2>
          <p> <?= htmlspecialchars($habitats['description']) ?> </p>
        </div>
      </div>
      <div class="conatainer-animals">
        
        <?php foreach ($listAnimals as $animal): ?>
      <a href="animal.php?id=<?=$animal['animal_id'] ?>" class="btn btn-primary">
        <div class="animals">
          <div class="wrapper-img">
          <?php if (!empty($animal['picture'])): ?>
                    <!-- Affichage de l'image en base64 -->
                    <img src="data:image/jpeg;base64,<?= base64_encode($animal['picture']); ?>" alt="Photo de <?= htmlspecialchars($animal['prenom']); ?>" />
                <?php else: ?>
                    <!-- Image par défaut si aucune image n'est disponible dans la base de données -->
                    <img src="img/default_animal.png" alt="Image par défaut" />
                <?php endif; ?>          
              </div>
          <h3>  <?= htmlspecialchars($animal['prenom']); ?></p>
       </div>
                </a>
        <?php endforeach; ?>
      </div>
    </div>
    
    <?php require_once __DIR__. "/templates/footer.php" ?>
