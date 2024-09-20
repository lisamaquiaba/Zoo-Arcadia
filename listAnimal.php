
 <?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/animal.php";

    if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'veterinaire') {
      header('location: index.php');
      exit;
  }

    $isAdminOnly = false;

    if (isset($user['role']) && $user['role'] === 'admin' ) {
      $isAdminOnly = true;
    }

    $listAnimals = getAnimals($pdo);
    
    ?> 

    <div class="bar">
      <h1>Les Animaux</h1>
    </div>
    <div class='wrapper-report'>
      <?php foreach ($listAnimals as $animal): ?>
        <div class='report'>
          <a
          href="animal.php?id=<?=$animal['animal_id'] ?>"
          class="btn btn-primary"
          ><?= htmlspecialchars($animal['prenom']); ?>
        </a>
        <a href="report.php?id=<?=$animal['animal_id'] ?>"
        >Compte Rendu</a>
      </div>

        <?php endforeach; ?> 
      </div>

     <?php require_once __DIR__. "/templates/footer.php" ?> 

