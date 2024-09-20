<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/animal.php";
    require_once __DIR__ . "/lib/habitat.php";
    require_once __DIR__ . "/lib/rapport.php";

    if(isset($_GET['id'])) { 
      $id = intval($_GET['id']);
    } else {
      echo "ID non fourni";
      exit;
    }
    
    $animal = getAnimalbyId($pdo, $id);

    if (!$animal) {
        echo "Animal non trouvé.";
        exit;
    }

    $habitat = getHabitatById($pdo, $animal['id_habitat']);
    
    $rapportVet = getLastRapportById($pdo, $animal['animal_id']);

    $imageBase64 = null;
    if (!empty($animal['picture'])) {
        $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($animal['picture']);
    }

?>
    <section>
      <div class="container-desc-animal">
        <div class="img-animal-desc">
          <div class="img-side">
          </div>
          <div>
            <?php if ($imageBase64): ?>
                <img class="img-main" src="<?= $imageBase64 ?>" alt="Photo de <?= htmlspecialchars($animal['prenom']) ?>" />
            <?php else: ?>
                <img src="img/default.png" alt="Photo par défaut" />
            <?php endif; ?>
          </div>
        </div>
        <div class="text-desc-animal">
          <div>
            <h2><?= htmlspecialchars($animal['prenom']) ?></h2>
          </div>
          <div>
            <p>Race : <?= htmlspecialchars($animal['race']) ?></p>

            <p>Habitat : <?= $habitat ? htmlspecialchars($habitat['nom']) : 'Aucun habitat trouvé' ?></p>
            
            <p>Nourriture proposée : <?= htmlspecialchars($animal['nourriture']) ?></p>
            <p>Grammage : <?= htmlspecialchars($animal['grammage']) ?> kg</p>
            
            <p>Avis du vétérinaire : <?= $rapportVet ? htmlspecialchars($rapportVet['detail']) : 'Aucun rapport vétérinaire' ?></p>
            <p>date de passage du vétérinaire : <?= $rapportVet ? htmlspecialchars($rapportVet['date']) : 'Aucun rapport vétérinaire' ?></p>
          </div>
        </div>
      </div>
    </section>
<?php require_once __DIR__. "/templates/footer.php" ?>
