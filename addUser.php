<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/user.php";

    // Vérification si l'utilisateur a un rôle admin
    if($_SESSION['user']['role'] !== 'admin') {
      // Redirection vers la page d'accueil
      header('location: index.php');
      exit;
    }

    if(isset($_POST['addUser']))  {

        $prenom = $_POST['prenom'] ?? ''; 
        $name = $_POST['name'] ?? ''; 
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        // Si tous les champs contiennent une valeur
       $message = addUser($pdo, $prenom, $name, $username, $password, $role);
      }

?>

<div class="bar">
    <h1>Créer un compte</h1>
</div>


<?php if (isset($message)): ?>
    <p style="color:black;"><?= htmlspecialchars($message); ?></p>
<?php endif; ?>

<form method='POST'>
 <div class="contact">
    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name='prenom' id='prenom'>
    </div>
    <div>
        <label for="nom">Nom</label>
        <input type="text" name='name' id='name'>
    </div>
    <div>
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name='username' id='username'>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name='password' id='password'>
    </div>
    <div>
        <label for="role">Rôle</label>
        <select name="role" id="role">
            <option value="">--Veuillez choisir un rôle--</option>
            <option value="employe">Employé</option>
            <option value="veterinaire">Vétérinaire</option>
            <option value="admin">Admin</option>
        </select>
    </div>
 </div>

    <button type='submit' name='addUser'>Créer un compte</button>
</form>

<?php require_once __DIR__. "/templates/footer.php" ?>
