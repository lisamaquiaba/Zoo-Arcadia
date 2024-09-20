<?php  
require_once __DIR__. "/templates/header.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/habitat.php";
require_once __DIR__ . "/lib/animal.php";
require_once __DIR__ . "/lib/image.php";


$listHabitats = getHabitats($pdo);

// Vérification si l'utilisateur a un rôle admin
if($_SESSION['user']['role'] !== 'admin') {
    header('location: index.php');
}

if(isset($_POST['addAnimal'])) {

    $imgContent = handleImageUpload($_FILES['image']); 

    $prenom = $_POST['prenom'] ?? ''; 
    $etat = $_POST['etat'] ?? ''; 
    $description = $_POST['description'] ?? ''; 
    $race = $_POST['race'] ?? ''; 
    $nourriture = $_POST['nourriture'] ?? ''; 
    $grammage = $_POST['grammage'] ?? ''; 
    $habitatId = intval($_POST['habitat']); 

    if(!empty($prenom) && !empty($etat) && !empty($description) && !empty($race) && !empty($grammage) && !empty($nourriture) && $imgContent !== null) {
        $message = addAnimal($pdo, $prenom, $etat, $description, $race, $grammage, $nourriture, $habitatId, $imgContent);
    } else {
        $message = "Veuillez remplir tous les champs, y compris la photo.";
    }
}
?>

<div class="bar">
    <h1>Ajouter un Animal</h1>
</div>

<form method='POST' enctype="multipart/form-data">
<div class="wrapper-form">
<div class="text-field">
<label for="">Prénom</label>
        <input type="text" name='prenom' id='prenom'>
    </div>
    <div class="text-field">
    <label for="">Etat</label>
        <input type="text" name='etat' id='etat'>
    </div>
    <div class="text-field">
    <label for="">Description</label>
        <input type="text" name='description' id='description'>
    </div>
    <div class="text-field">
    <label for="">Race</label>
        <input type="text" name='race' id='race'>
    </div>
    <div class="text-field">
    <label for="">Nourriture</label>
        <input type="text" name='nourriture' id='nourriture'>
    </div>
    <div class="text-field">
    <label for="">Grammage</label>
        <input type="text" name='grammage' id='grammage'>
    </div>
    <div class="text-field">
    <label for="picture">Photo : </label>
        <input type="file" name="image" accept="image/*">
    </div>
    <select name="habitat" id="habitat-select">
        <option value="">--Please choose an option--</option>
        <?php foreach ($listHabitats as $habitats): ?>
            <option value="<?=$habitats['habitat_id'] ?>"><?= htmlspecialchars($habitats['nom']); ?></option>
        <?php endforeach; ?>
    </select>    
    <button class='button-sub' type='submit' name='addAnimal'>Ajouter un animal</button>
    <?php if (isset($message)): ?>
    <p style="color: red"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
        </div>
</form>

<?php require_once __DIR__. "/templates/footer.php" ?>
