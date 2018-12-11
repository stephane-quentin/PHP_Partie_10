<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>TP 1 PHP Partie 10</title>
  </head>
  <body>
    <?php
    //initialisation d'un tablau vide
    $errors = [];
    if (isset($_POST['submit'])) {
      $date = new DateTime($_POST['birthDate']);
      if (!empty($_POST)) {
      //Si tous les champs ne sont pas vides
        //Si le champ lastName st completé et s'il ne correspond pas à la Regex donnée
        //Alors on ajoute un message au tableau d'erreurs ($errors)
        if (isset($_POST['lastName']) && !preg_match('#[A-Z]{1}[a-zÀ-ÿ -]+$#', $_POST['lastName'])) {
          $errors[] = 'Le nom n\'est pas valide';
        }
        if (isset($_POST['firstName']) && !preg_match('#[A-Z]{1}[a-zÀ-ÿ -]+$#', $_POST['firstName'])) {
          $errors[] = 'Le prénom n\'est pas valide';
        }
        if (isset($_POST['birthCountry']) && !preg_match('#[A-Za-zÀ-ÿ -]+$#', $_POST['birthCountry'])) {
          $errors[] = 'Le pays n\'est pas valide';
        }
        if (isset($_POST['nationality']) && !preg_match('#[A-Za-zÀ-ÿ -]+$#', $_POST['nationality'])) {
          $errors[] = 'La nationalité n\'est pas valide';
        }
        if (isset($_POST['postalCode']) && !preg_match('#[0-9]{5}+$#', $_POST['postalCode'])) {
          $errors[] = 'Le code postal n\'est pas valide';
        }
        if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          $errors[] = 'L\'email n\'est pas valide';
        }
        if (isset($_POST['phone']) && !preg_match('#[0]{1}[1-7]{1}[0-9]{8}+$#', $_POST['phone'])) {
          $errors[] = 'Le numéro de téléphone n\'est pas valide';
        }
        if (isset($_POST['poleEmploi']) && !preg_match('#^[0-9]{7}[A-Z]{1}$#', $_POST['poleEmploi'])) {
          $errors[] = 'Le numéro Pole Emploi n\'est pas valide';
        }
        if (isset($_POST['badgeNumber']) && !preg_match('#[0-6]{1}+$#', $_POST['badgeNumber'])) {
          $errors[] = 'Le nombre de badge n\'est pas valide';
        }
        if (isset($_POST['codecademy']) && !filter_var($_POST['codecademy'], FILTER_VALIDATE_URL)){
          $errors[] = 'Le lien codecademy n\'est pas valide';
        }
      }else{
        $errors[] = 'Au moins un champ est vide, merci de le remplir';
      }
    }
    if (isset($_POST['submit']) && (count($errors) == 0)) {
    // Si bouton appuyé et aucune erreur, on affiche les infos
      ?>
      <div class="jumbotron">
        <p><span class="font-weight-bold">Nom : </span><?= htmlspecialchars($_POST['lastName']); ?></p>
        <p><span class="font-weight-bold">Prénom : </span><?= htmlspecialchars($_POST['firstName']); ?></p>
        <p><span class="font-weight-bold">Date de naissance : </span><?= $date->format('d/m/Y'); ?></p>
        <p><span class="font-weight-bold">Pays de naissance : </span><?= htmlspecialchars($_POST['birthCountry']); ?></p>
        <p><span class="font-weight-bold">Nationalité : </span><?= htmlspecialchars($_POST['nationality']); ?></p>
        <p><span class="font-weight-bold">Adresse : </span><?= htmlspecialchars($_POST['street']); ?></p>
        <p><span class="font-weight-bold">Code Postal : </span><?= htmlspecialchars($_POST['postalCode']); ?></p>
        <p><span class="font-weight-bold">Ville : </span><?= htmlspecialchars($_POST['city']); ?></p>
        <p><span class="font-weight-bold">Email : </span><?= htmlspecialchars($_POST['email']); ?></p>
        <p><span class="font-weight-bold">Téléphone : </span><?= htmlspecialchars($_POST['phone']); ?></p>
        <p><span class="font-weight-bold">Diplôme : </span><?= $_POST['qualification']; ?></p>
        <p><span class="font-weight-bold">Numéro pôle emploi : </span><?= htmlspecialchars($_POST['poleEmploi']); ?></p>
        <p><span class="font-weight-bold">Nombre de badge : </span><?= htmlspecialchars($_POST['badgeNumber']); ?></p>
        <p><span class="font-weight-bold">Liens codecademy : </span><?= htmlspecialchars($_POST['codecademy']); ?></p>
        <p><span class="font-weight-bold">Si vous étiez un super héros/une super héroïne, qui seriez-vous et pourquoi? : </span><?= htmlspecialchars($_POST['heroes']); ?></p>
        <p><span class="font-weight-bold">Racontez-nous un de vos "hacks" (pas forcément technique ou informatique) : </span><?= htmlspecialchars($_POST['hacks']); ?></p>
        <p><span class="font-weight-bold">Avez vous déjà eu une expérience avec la programmation et/ou l'informatique avant de remplir ce formulaire ? : </span><?= htmlspecialchars($_POST['experience']); ?></p>
        <p><a href="index.php" class="btn btn-primary">Retour au formulaire</a></p>
      </div>
      <?php
    }else{
    // Sinon on affiche le formulaire
    ?>
    <div class="jumbotron">
    <p><a href="http://monProjet" class="btn btn-danger">Accueil</a></p>
    <p><h1 class="alert alert-success text-center" id="titre">Formulaire d'inscription la Manu</h1></p>
    <?php
      // Si le tableau d'erreurs ($errors) n'est pas vide, on affiche les erreurs dans une liste
      if (count($errors) > 0){
        ?>
        <div class="alert alert-danger">
          <p>Veuillez corriger le(s) erreur(s) suivante(s) :</p>
          <ul>
          <?php
            foreach($errors as $error){
          ?>
            <li><?= $error; ?></li>
          <?php
          }
          ?>
          </ul>
        </div>
      <?php
      }
    ?>
    <form method="post">
      <div class="row">
        <div class="col-6">
        <p><label class="font-weight-bold">Nom :</label>
        <input type="text" name="lastName" class="form-control" value="<?= htmlspecialchars($_POST['lastName']); ?>" required/></p>
        </div>
        <div class="col-6">
        <p><label class="font-weight-bold">Prénom :</label>
        <input type="text" name="firstName" class="form-control" value="<?= htmlspecialchars($_POST['firstName']); ?>" required/></p>
        </div>
      </div>
      <div class="row">
        <div class="col-2">
        <p><label class="font-weight-bold">Date de naissance :</label>
        <input type="date" name="birthDate" class="form-control" value="<?= $_POST['birthDate']; ?>" required/></p>
        </div>
        <div class="col-5">
        <p><label class="font-weight-bold">Pays de naissance :</label>
        <input type="text" name="birthCountry" class="form-control" value="<?= htmlspecialchars($_POST['birthCountry']); ?>" required/></p>
        </div>
        <div class="col-5">
        <p><label class="font-weight-bold">Nationalité :</label>
        <input type="text" name="nationality" class="form-control" value="<?= htmlspecialchars($_POST['nationality']); ?>" required/></p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
        <p><label class="font-weight-bold">Adresse :</label>
        <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($_POST['street']); ?>" required/></p>
        </div>
        <div class="col-2">
        <p><label class="font-weight-bold">Code Postal :</label>
        <input type="text" name="postalCode" class="form-control" minlength="5" maxlength="5" value="<?= htmlspecialchars($_POST['postalCode']); ?>" required/></p>
        </div>
        <div class="col-4">
        <p><label class="font-weight-bold">Ville :</label>
        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($_POST['city']); ?>" required/></p>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
        <p><label class="font-weight-bold">Email :</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email']); ?>" required/></p>
        </div>
        <div class="col-4">
        <p><label class="font-weight-bold">Téléphone :</label>
        <input type="text" name="phone" class="form-control" minlength="10" maxlength="10" value="<?= htmlspecialchars($_POST['phone']); ?>" required/></p>
        </div>
      </div>
      <div class="row">
        <div class="col-2">
        <br>
        <p><label class="font-weight-bold mt-3">Diplôme :</label>
          <select name="qualification" required>
            <option selected disabled>Choix</option>
            <option value="Sans" <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 'Sans') echo 'selected' ; ?>>Sans</option>
            <option value="Bac" <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 'Bac') echo 'selected' ; ?>>Bac</option>
            <option value="Bac+2" <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 'Bac+2') echo 'selected' ; ?>>Bac+2</option>
            <option value="Bac+3" <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 'Bac+3') echo 'selected' ; ?>>Bac+3</option>
            <option value="Supérieur" <?php if (isset($_POST['qualification']) && $_POST['qualification'] == 'Supérieur') echo 'selected' ; ?>>Supérieur</option>
          </select></p>
        </div>
        <div class="col-5">
        <p><label class="font-weight-bold">Numéro pôle emploi :</label>
        <input type="text" name="poleEmploi" class="form-control" minlength="8" maxlength="8" value="<?= htmlspecialchars($_POST['poleEmploi']); ?>" required/></p>
        </div>
        <div class="col-5">
        <p><label class="font-weight-bold">Nombre de badge :</label>
        <input type="text" name="badgeNumber" class="form-control" min="0" max="6" minlength="1" maxlength="1" value="<?= htmlspecialchars($_POST['badgeNumber']); ?>" required/></p>
        </div>
      </div>
      <p><label class="font-weight-bold">Lien codecademy :</label>
      <input type="text" name="codecademy" class="form-control" value="<?= htmlspecialchars($_POST['codecademy']); ?>" required/></p>
      <p class="text-center"><label class="font-weight-bold">Si vous étiez un super héros/une super héroïne, qui seriez-vous et pourquoi?</label></p>
      <p class="text-center"><textarea name="heroes" rows="8" cols="166" required><?php if(isset($_POST['heroes'])) { echo htmlentities($_POST['heroes']); } ?></textarea></p>
      <p class="text-center"><label class="font-weight-bold">Racontez-nous un de vos "hacks" (pas forcément technique ou informatique)</label></p>
      <p class="text-center"><textarea name="hacks" rows="8" cols="166" required><?php if(isset($_POST['hacks'])) { echo htmlentities($_POST['hacks']); } ?></textarea></p>
      <p class="text-center"><label class="font-weight-bold">Avez vous déjà eu une expérience avec la programmation et/ou l'informatique avant de remplir ce formulaire ?</label></p>
      <p class="text-center"><textarea name="experience" rows="8" cols="166" required><?php if(isset($_POST['experience'])) { echo htmlentities($_POST['experience']); } ?></textarea></p>
      <input type="submit" name="submit" value="Envoyer le formulaire" class="btn btn-primary"/>
    </form>
    </div>
    <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
