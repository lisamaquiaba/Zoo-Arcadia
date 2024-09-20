<?php 
    require_once __DIR__ . "/templates/header.php"; 
    require_once __DIR__ . "/lib/pdo.php"; 
    require_once __DIR__ . "/lib/user.php";

    $errors = [];

    if (isset($_POST['loginUser'])) {
        $user = verifyUserLoginPassword($pdo, $_POST['username'], $_POST['password']);       
        if ($user) {
            $_SESSION['user'] = $user;
            header('location: index.php');
        } else {
            $errors[] = "Pseudo ou mot de passe incorrect";
        }
       

    }
?>
    <section class="container-connexion">
      <div class="connexion">
        <h1>Connexion</h1>
        <?php
        foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?=$error; ?>
        </div>
       <?php }
    ?>
        <form method="post" action="" class="formulaire">
          <div class="username">
            <label for="username">Username</label>
          </div>
          <div>
            <input
              type="text"
              name="username"
              id="username"
              placeholder="username"
            />
          </div>
          <div class="password">
            <label for="password">Mot de passe</label>
          </div>
          <div>
            <input type="password" name="password" id="password" />
          </div>
          <div><button type="submit" name="loginUser" class="button-co">Se connecter<button ></div>
        </form>
      </div>
    </section>
    <?php require_once __DIR__. "/templates/footer.php" ?>