<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/habitat.php";
    require_once __DIR__ . "/lib/image.php";

    if($_SESSION['user']['role'] !== 'admin') {
        header('location: index.php');
        exit;
    }
   
    if(isset($_POST['update']))  {        
        foreach ($_POST['habitat'] as $id => $habitat) {
            $imgContent = null; 

            if (isset($_FILES['habitat']['name'][$id]['picture']) && $_FILES['habitat']['error'][$id]['picture'] === UPLOAD_ERR_OK) {
                $image = $_FILES['habitat']['tmp_name'][$id]['picture'];
                if ($_FILES['habitat']['size'][$id]['picture'] < 1000000) { // Taille maximale 1 Mo
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

           
            updateHabitat($pdo, $imgContent, $habitat, $id);
        }

        header('Location: '.$_SERVER['PHP_SELF']);
        exit;
    }

   
    $listHabitats = getHabitats($pdo);
?>

<main>
  <div class="bar">
    <h1>Modification Habitats</h1>
  </div>
<section>
  <form method="POST" enctype="multipart/form-data"> 
  <div class="wrapper-form">
    <?php foreach ($listHabitats as $habitats): ?>
      <div class="wrapper-field">
      <div class="text-field">
        <label for="nom_<?= $habitats['habitat_id']; ?>">Nom :</label>
        <input type="text" id="nom_<?= $habitats['habitat_id']; ?>" name="habitat[<?= $habitats['habitat_id']; ?>][nom]" value="<?= htmlspecialchars($habitats['nom']); ?>" />
    </div>

    <div class="text-field">
        <label for="description_<?= $habitats['habitat_id']; ?>">Description :</label>
        <textarea id="description_<?= $habitats['habitat_id']; ?>" name="habitat[<?= $habitats['habitat_id']; ?>][description]"><?= htmlspecialchars($habitats['description']); ?></textarea>
        </div>
    <div class="text-field">
          <label for="nom_<?= $habitats['habitat_id']; ?>">Commentaire :</label>
        <input type="text" id="commentaire_habitat<?= $habitats['habitat_id']; ?>" name="habitat[<?= $habitats['habitat_id']; ?>][commentaire_habitat]" value="<?= htmlspecialchars($habitats['commentaire_habitat']); ?>" />
        </div>


        <label for="image_<?= $habitats['habitat_id']; ?>">Image</label>
        <input type="file" name="habitat[<?= $habitats['habitat_id']; ?>][picture]" accept="image/*" />
      </div>
    <?php endforeach; ?>
    
    <button class='button-sub' type="submit" name='update'>Mettre à jour</button>
    </div>
  </form>
  </section>
</main>

<?php require_once __DIR__. "/templates/footer.php" ?>
