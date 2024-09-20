<?php
    require_once __DIR__ . "/../lib/session.php"; 

    $userFirstName = '';
    $isAdminOrEmploye = false;
    $isAdminOnly = false;
    // si on a bien une session (si on est connecté)
    if(isset($_SESSION['user'])) {
      // la variable $user possède tous les données de l'utilisateur qui est connecté
      $user = $_SESSION['user'];

      $userFirstName = htmlspecialchars($user['prenom']);

      // Vérification si l'utilisateur est un ADMIN OU EMPLOYE
      if (isset($user['role']) && $user['role'] === 'admin' || $user['role'] === 'employe') {
        $isAdminOrEmploye = true;
    }

      // Vérification si l'utilisateur est un ADMIN
    if (isset($user['role']) && $user['role'] === 'admin' ) {
      $isAdminOnly = true;
  }

    }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zoo Arcadia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
      rel="stylesheet"
    />
    <link href="style.css" rel="stylesheet" />
  </head>
  <body>
<header class="topbar">
      <nav class="navbar">
        <a href="index.php">
          <img
            class="logo"
            src="img/zoo_arcadia_logo.png"
            alt="Logo du Zoo Arcadia"
          />
        </a>
        <div class="wrapper-link">
          <a class="active" href="index.php">Accueil</a>
          <a href="services.php">Nos Services</a>
          <a href="habitats.php">Leurs habitats</a>
          <a href="avis.php">Avis</a>
          <?php if (isset($user)): ?>
            <a href="profile.php?id=<?=$user['id'] ?>"> 
              <?= htmlspecialchars($user['prenom']) ?>
            </a>         
            <a href="logout.php">Déconnexion</a>         
            <?php else: ?>
              <a href="connexion.php" class="button">Connexion</a>
                <?php endif; ?>        
         
        </div>
        <div class="nav-mobile">
          <a class="active" href="index.php">Accueil</a>
          <a href="services.php">Nos Services</a>
          <a href="habitats.php">Leurs habitats</a>
          <a href="avis.php">Avis</a>
          <?php if (isset($user)): ?>
            <a href="profile.php?id=<?=$user['id'] ?>"> 
              <?= htmlspecialchars($user['prenom']) ?>
            </a>         
            <a href="logout.php">Déconnexion</a>         
            <?php else: ?>
              <a href="connexion.php" class="button">Connexion</a>
                <?php endif; ?>

        </div>
        <span class="nav-toggle"><img src="img/list.png" alt="" /></span>
      </nav>
    </header>