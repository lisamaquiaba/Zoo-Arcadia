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
     
     header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id);
     exit;

    }

?>
    <section>
    <div class="bar">
    <h2>Rapport de <?= htmlspecialchars($animal['prenom']); ?> </h2>
    </div>
    <div class='wrapper-rapport'>
      <h2>Historique</h2>
    <?php foreach ($rapportVet as $rapport): ?>
         <div>
           <span><?= htmlspecialchars($rapport['date']); ?> : </span>
              <span><?= htmlspecialchars($rapport['detail']); ?></span>
         </div>
       <?php endforeach; ?>
       </div>
       <div>
        <form method='POST'>
        <div class="wrapper-form">

        <div class="text-field">
            <label for="">Rapport : </label>
            <textarea name="report"></textarea>
          </div>
          <button class='button-sub' type='submit' name='addReport'>Envoyer rapport</button>
        </div>
        </form>
        </div>

      
    </section>
<?php require_once __DIR__. "/templates/footer.php" ?>

