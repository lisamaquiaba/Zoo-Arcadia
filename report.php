<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/animal.php";
    require_once __DIR__ . "/lib/habitat.php";
    require_once __DIR__ . "/lib/rapport.php";

    if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'veterinaire') {
      header('location: index.php');
      exit;
  }

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

    $habitat = getHabitatById($pdo,  $animal['id_habitat']);

    $rapportVet = getAllRapport($pdo, $animal['animal_id']);

    if(isset($_POST['addReport']))  {

      $report = $_POST['report'] ?? ''; 
     
     $message = addRapport($pdo, $report, $id);
    
    }

?>
    <section>
    <div class="bar">
    <h2>Compte rendu <?= htmlspecialchars($animal['prenom']); ?> </h2>
    </div>

    <?php foreach ($rapportVet as $rapport): ?>
         <div>
              <h2><?= htmlspecialchars($rapport['detail']); ?></h2>
              <p><?= htmlspecialchars($rapport['date']); ?></p>
         </div>
       <?php endforeach; ?>
       <div>
        <form method='POST'>
          <label for="">Rapport vétérinaire</label>
          <textarea name="report"></textarea>
          <button type='submit' name='addReport'>Envoyer rapport</button>
        </form>
        </div>

      
    </section>
<?php require_once __DIR__. "/templates/footer.php" ?>

