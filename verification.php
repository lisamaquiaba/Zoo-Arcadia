<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/avis.php";


    if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe') {
      header('location: index.php');
      exit;
  }
    
    $listAvis = getAllAvis($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST['avis'] as $idAvis => $isVisible) {
            $isVisible = ($isVisible == '1') ? 1 : 0;
            updateAprouvedAvis($pdo, $isVisible, $idAvis);
        }

        header('location: index.php');
        exit;
    }
?>
<main>
  <div class="bar">
    <h1>Vérification</h1>
  </div>

  <form method='POST'>
    <section>
      <?php foreach ($listAvis as $avis): ?>
      <div class="review">
        <p class="test">
          Pseudo: <?= htmlspecialchars($avis['pseudo']); ?>
        </p>
        <p class="test">
          Commentaire : <?= htmlspecialchars($avis['comment']); ?>
        </p>
        <p class="test">
          à Approuver
          <?php
            $checked = ($avis['isVisible'] == 1) ? 'checked' : '';
          ?>
          <input type="hidden" name="avis[<?= $avis['id'] ?>]" value="0" />
          <input type="checkbox" name="avis[<?= $avis['id'] ?>]" value="1" <?= $checked ?> />
        </p>
      </div>
      <?php endforeach; ?>
    </section>

    <button type="submit">Modifier</button>
  </form>
</main>
<?php require_once __DIR__. "/templates/footer.php" ?>
