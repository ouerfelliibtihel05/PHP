 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>s'inscrire</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>s'inscrire</title>
    <link rel="stylesheet" href="style.css">
  <style>

body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
}

header {
  background-color: #000;
  color: #fff;
  padding: 20px;
}

h1 {
  font-size: 2em;
  margin-top: 0;
  text-align: center;
}

main {
  width: 500px;
  margin: 0 auto;
}

section {
  padding: 20px;
}

form {
  width: 100%;
}

.form-group {
  margin-bottom: 10px;
}

label {
  font-size: 1.2em;
}

input,
button {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1.2em;
}

.btn-primary {
  background-color: green;
  color: #fff;
}

footer {
  background-color: #ccc;
  padding: 20px;
  position: fixed;
  bottom: 0;
  width: 100%;
  text-align: center;
}  
</style>

    <header>
    <h1>s'inscrire</h1>
  </header>
  <main>
    <section>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="email">e-mail </label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="motpasse" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" value="envoyer">Se connecter</button><br><br>
        <button type="submit" class="btn btn-primary" value="sinscrire" onclick="ToAjout()">S'inscrire</button>
      </form>
    </section>
  </main>
  <footer>
    <p>Copyright &copy; 2023 Flestee</p>
  </footer>
  <?php
    include('connexion.php');
    $idcon = connect('locationvoiturebd');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idcon->exec('USE locationvoiturebd');
        $email = $idcon->quote($_POST['email']);
        $motpasse = $idcon->quote($_POST['motpasse']);

        $requeteUser = "SELECT * FROM utilisateur WHERE email = $email AND motpasse = $motpasse";
        $stmtUser = $idcon->prepare($requeteUser);
        $stmtUser->execute();

        $requeteClient = "SELECT * FROM clients WHERE email = $email AND motpasse = $motpasse";
        $stmtClient = $idcon->prepare($requeteClient);
        $stmtClient->execute();

        if ($stmtUser->rowCount() > 0) {
          header('Location: menuadmin.php');
          exit();
      } else if ($stmtClient->rowCount() > 0) {
          header('Location: menuclient.php');
          exit();
      } 
      else{
        echo"<script type=\"text/javascript\">alert('votre identification est incorrect ')</script>";
      }
       
    }

    $idcon = null;
    ?>
        <script>
        function ToAjout() {
            window.location.href = 'ajoutClient.php';
        }
    </script>

</body>
 </html>