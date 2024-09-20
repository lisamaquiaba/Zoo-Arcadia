
<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/avis.php";
    
        $listAvis = getAvisVisible($pdo);
?>

  <body>
  
    <section>
      <div class="banniere"></div>
      <div class="text-hover">
        <h1>Bienvenu au Zoo Arcadia !</h1>
        <p>
          Situé en France, près de la forêt Brocéliande en Bretagne depuis 1960,
          le zoo Arcadia est une destination incroyable pour une journée unique.
          Que vous soyez en famille, entre amis ou bien seul, le Zoo Arcadia
          vous ouvre ses portes de 10 heures à 19 heures la semaine et de 10
          heures à 19 heures les week-ends pour y découvrir sa grande diversité
          d’animaux venant de différents éco-systèmes, chacun vivant dans un
          habitat reproduisant leur habitat naturel. Le personnel de
          l’établissement prend à coeur la santé de nos animaux et s’assurent
          chaque jour de leur bon état de santé. Arcadia vous propose également
          plusieurs service : le restaurant Arcadia, la visite des habitat avec
          un guide et même une visite complète du zoo en petit train !
        </p>
      </div>
    </section>
    <section class="container-services">
      <div class="accueil-animals">
        <div>
          <img
            class="img-services"
            src="img/leopard_accueil.png"
            alt="Photo d'un léopard"
          />
        </div>
        <div class="wrapper-description">
            <h2 class="title-accueil">Nos Animaux</h2>
          <p>
            Au sein du zoo Arcadia, vous pourrez découvrir une grande variété
            d’animaux tous aussi incroyable les uns que les autres: parmi eux,
            les lions, la grâce et l’élégance des léopards en passant par la
            présence imposante et impressionnante de nos alligators.
          </p>
        </div>
      </div>
      <div class="accueil-animals-reverse">
        <div class="wrapper-description">
            <h2 class="title-accueil">Les habitats</h2>
          <p>
            Pour que nos animaux puissent vivre dans de bonnes conditions, nous
            avons, avec soin, recréer leurs habitats naturel. En passant par la
            jungle dense, l’immense savane et le marais mystérieux, tout est mit
            en œuvre pour le bien-être de nos précieux animaux.
          </p>
        </div>

        <div>
          <img
            class="img-services"
            src="img/marais_accueil.png"
            alt="Photo d'un marais avec des pélicans"
          />
        </div>
      </div>
      <div class="accueil-animals">
        <div>
          <img
            class="img-services"
            src="img/burger_accueil.png"
            alt="Photo d'un hamburger"
          />
        </div>
        <div class="wrapper-description">
            <h2 class="title-accueil">Nos Services</h2>
          <p class="text-section">
            Au zoo Arcadia, nous nous soucions de nos visiteurs autant que de
            nos animaux. c’est pour cela que plusieurs services sont mis a votre
            disposition pour votre propre confort.
          </p>
          <p>
            Notre restaurant est là pour vous servir avec différentes options,
            pour tous les goûts (convient aux végétariens). Pour étendre vos
            connaissances sur les animaux, nous vous proposons une visite guidée
            et gratuite sur nos différents habitats. Nos experts sauront vous
            transmettre leurs passions pour les animaux et vous faire découvrir
            des choses dont vous n’avez peut-être pas connaissance. Enfin,
            montez à bord de notre magnifique train pour une visite du zoo plus
            calme et décontracté.
          </p>
        </div>
      </div>
    </section>
    <div class="google-review">
      <p>Noté 4.7 sur</p>
      <img class="logo-google" src="img/google_logo.png" alt="Logo Google" />
      <div>
        <img class="stars" src="img/stars.png" alt="4.7 étoiles sur Google" />
      </div>
    </div>
    <div class="review">
      <h3>Quelques avis de nos visiteurs...</h3> 
      <div>
      <?php foreach ($listAvis as $avis): ?>
        <p>  <?= htmlspecialchars($avis['pseudo']); ?></p> 
        <p>  <?= htmlspecialchars($avis['comment']); ?></p><hr>
      <?php endforeach; ?>
      </div>
    </div>
  
<?php require_once __DIR__. "/templates/footer.php" ?>