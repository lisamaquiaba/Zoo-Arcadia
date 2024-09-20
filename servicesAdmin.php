<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/service.php";

    if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'employe') {
        header('location: index.php');
        exit;
    }
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST['services'] as $id => $service) {
            $imgContent = null; 

            if (isset($_FILES['services']['name'][$id]['picture']) && $_FILES['services']['error'][$id]['picture'] === UPLOAD_ERR_OK) {
                $image = $_FILES['services']['tmp_name'][$id]['picture'];
                if ($_FILES['services']['size'][$id]['picture'] < 1000000) { // Taille maximale 1 Mo
                    $fileType = mime_content_type($image);
                    if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                        $imgContent = file_get_contents($image);
                    } else {
                        echo 'Format d\'image non supporté (JPEG, PNG, GIF uniquement).';
                    }
                } else {
                    echo 'Le fichier est trop volumineux. Limite de 1 Mo.';
                }
            }

            $query = $pdo->prepare('UPDATE services SET nom = :nom, description = :description' . ($imgContent ? ', picture = :picture' : '') . ' WHERE service_id = :id');
            $params = [
                'nom' => $service['nom'],
                'description' => $service['description'],
                'id' => $id,
            ];
            if ($imgContent) {
                $params['picture'] = $imgContent; 
            }
            $query->execute($params);
        }

        header('Location: '.$_SERVER['PHP_SELF']);
        exit;
    }

    
    $listServices = getService($pdo);
?>

<main>
  <div class="bar">
    <h1>MODIFICATION SERVICES</h1>
  </div>
<section class="wrapper-form">
  <form method="POST" enctype="multipart/form-data"> <!-- Ajout de enctype -->
    <?php foreach ($listServices as $services): ?>
      <div class="wrapper-field">
        
      <div class="text-field">
          <label for="nom_<?= $services['service_id']; ?>">Nom :</label>
          <input type="text" id="nom_<?= $services['service_id']; ?>" name="services[<?= $services['service_id']; ?>][nom]" value="<?= htmlspecialchars($services['nom']); ?>" />
    </div>
    <div class="text-field">
          <label for="description_<?= $services['service_id']; ?>">Description :</label>
          <textarea id="description_<?= $services['service_id']; ?>" name="services[<?= $services['service_id']; ?>][description]"><?= htmlspecialchars($services['description']); ?></textarea>
          </div>
          <label for="image_<?= $services['service_id']; ?>">Image</label>
          <input type="file" name="services[<?= $services['service_id']; ?>][picture]" accept="image/*" />
        </div>
      </div>
    <?php endforeach; ?>
    
    <button class='button-sub' type="submit" class="button">Mettre à jour</button>
  </form>
  </section>
</main>

<?php require_once __DIR__. "/templates/footer.php" ?>
