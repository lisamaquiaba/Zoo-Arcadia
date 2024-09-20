

     <?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/user.php";

    if($_SESSION['user']['role'] !== 'admin') {
      header('location: index.php');
      exit;
    }

    if(isset($_POST['addUser']))  {

        $prenom = $_POST['prenom'] ?? ''; 
        $name = $_POST['name'] ?? ''; 
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

       $message = addUser($pdo, $prenom, $name, $username, $password, $role);
      }

?> 

    <div class="bar">
      <h1>Créer un compte</h1>
    </div>

    

    <form method="POST">
      <div class="wrapper-form">
        <div class="text-field">
          <label for="prenom">Prénom : </label>
          <input type="text" name="prenom" id="prenom" placeholder="Prénom" />
        </div>
        <div class="text-field">
          <label for="nom">Nom : </label>
          <input type="text" name="name" id="name" placeholder="Nom" />
        </div>
        <div class="text-field">
          <label for="username">Nom d'utilisateur : </label>
          <input type="text" name="username" placeholder="username" />
        </div>
        <div class="text-field">
          <label for="password">Mot de passe : </label>
          <input type="password" name="password" placeholder="password" />
        </div>
        <div class="text-field">
          <label for="role">Rôle : </label>
          <select name="role" id="role">
            <option value="">--Veuillez choisir un rôle--</option>
            <option value="employe">Employé</option>
            <option value="veterinaire">Vétérinaire</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button class="button-sub" type="submit" name="addUser">
          Créer un compte
        </button>
        <?php if (isset($message)): ?>
    <p style="color: red"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
      </div>
    </form>

 <?php require_once __DIR__. "/templates/footer.php" ?>
