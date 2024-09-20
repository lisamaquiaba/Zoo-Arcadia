<?php  
    require_once __DIR__. "/templates/header.php";
    require_once __DIR__ . "/lib/pdo.php";
    require_once __DIR__ . "/lib/avis.php";

  if(isset($_POST['addAvis']))  {

    $pseudo = $_POST['pseudo'] ?? ''; // test
    $comment = $_POST['comment'] ?? ''; // test

    $message = createAvis($pdo, $pseudo, $comment);

  }
  
?>
    <main>
      <div class="bar">
        <h1>Avis</h1>
        <p>
          Envie de nous parler de votre visite ou bien nous conseiller des points
          à améliorer? N'hésitez pas à nous laisser un avis !
        </p>
      </div>
      <section>
        <div class="contact">
          <form method="post" class="formulaire">
            <div>
              <label for="pseudo">Votre pseudo</label>
            </div>
            <div class="pseudo">
              <input type="text" name="pseudo" id="pseudo" />
            </div>
            <div>
              <label for="avis">Votre avis</label>
            </div>
            <div><textarea name="comment" id="comment"></textarea></div>
            <div><button type="submit" name='addAvis'class="submit">Soumettre</button></div>
          
          </form>
        </div>
      </section>
    </main>
    <?php require_once __DIR__. "/templates/footer.php" ?>