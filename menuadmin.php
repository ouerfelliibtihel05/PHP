<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon site</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>

  
body {
  font-family: sans-serif;
  background: linear-gradient(to right, #4e54c8, #8f94fb), url('./images/16.jpg') center center fixed;
  background-size: cover;
  background-repeat: no-repeat;
  color: #fff;
  margin: 0;
  padding: 0;
}


nav {
  background-color: #ffffff;
  border-bottom: 1px solid #ccc;
}

.navbar-brand {
  font-size: 2em;
}

.navbar-nav a {
  font-size: 1.5em;
}

.container {
  margin-top: 40px;
}

h1 {
  font-size: 2em;
}

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./menuadmin.php" >Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Histo.php">HistoriqueV</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="supprimerclient.php">SupprimerClient</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="supprimerVehicule.php">supprimerVehicule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="histoclient.php">HistoriqueC</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./afficherClient.php">Membre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./afficherVehicule.php">Vehicule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./ajoutvehicules.php">AjouterV</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./modvec.php">ModifierV</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sinscrire.php">LogOut</a>
        </li>
       
      </ul>
     

    </div>
  </div>
</nav>



</body>
</html>