<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>TP 2 PHP Partie 10</title>
  </head>
  <body>
    <?php
    $errors = [];
    if (isset($_POST['submit'])) {
      if (!empty($_POST)) {
        if (isset($_POST['lastName']) && !preg_match('#[A-Z]{1}[a-z -]+$#', $_POST['lastName'])) {
          $errors[] = 'Le nom n\'est pas valide';
        }
        if (isset($_POST['firstName']) && !preg_match('#[A-Z]{1}[a-z -]+$#', $_POST['firstName'])) {
          $errors[] = 'Le prénom n\'est pas valide';
        }
        if (isset($_POST['age']) && !filter_var($_POST['age'], FILTER_VALIDATE_INT, array("options" => array("min_range" => 18, "max_range" => 120)))) {
          $errors[] = 'L\'age n\'est pas valide';
        }
      }else{
        $errors[] = 'Au moins un champ est vide, merci de le remplir';
      }
    }
    ?>
    <div class="jumbotron">
    <p><a href="http://monProjet" class="btn btn-danger">Accueil</a></p>
    <p><h1 class="alert alert-success text-center" id="titre">Formulaire d'inscription</h1></p>
    <?php
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
      <p><label class="font-weight-bold">Civilité :</label>
      <select name="civility" required>
        <option selected disabled>Choix</option>
        <option value="Mr" <?php if (isset($_POST['civility']) && $_POST['civility'] == 'Mr') echo 'selected' ; ?>>Mr</option>
        <option value="Mme" <?php if (isset($_POST['civility']) && $_POST['civility'] == 'Mme') echo 'selected' ; ?>>Mme</option>
      </select></p>
      <p><label class="font-weight-bold">Nom :</label>
      <input type="text" name="lastName" class="form-control col-4" value="<?= htmlspecialchars($_POST['lastName']); ?>" required/></p>
      <p><label class="font-weight-bold">Prénom :</label>
      <input type="text" name="firstName" class="form-control col-4" value="<?= htmlspecialchars($_POST['firstName']); ?>" required/></p>
      <p><label class="font-weight-bold">Age :</label>
      <input type="text" name="age" class="form-control col-4" value="<?= htmlspecialchars($_POST['age']); ?>" required/></p>
      <p><label class="font-weight-bold">Société :</label>
      <input type="text" name="society" class="form-control col-4" value="<?= htmlspecialchars($_POST['society']); ?>" required/></p>
      <input type="submit" name="submit" value="Envoyer le formulaire" class="btn btn-primary"/>
    </form>
    <?php
    if (isset($_POST['submit']) && (count($errors) == 0)) {
      ?>
      <div class="jumbotron">
        <p><span class="font-weight-bold">Civilité : </span><?= $_POST['civility']; ?></p>
        <p><span class="font-weight-bold">Nom : </span><?= htmlspecialchars($_POST['lastName']); ?></p>
        <p><span class="font-weight-bold">Prénom : </span><?= htmlspecialchars($_POST['firstName']); ?></p>
        <p><span class="font-weight-bold">Age : </span><?= htmlspecialchars($_POST['age']); ?></p>
        <p><span class="font-weight-bold">Société : </span><?= htmlspecialchars($_POST['society']); ?></p>
      </div>
      <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
