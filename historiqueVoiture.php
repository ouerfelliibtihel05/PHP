<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historique de la voiture</title>
  <link rel="stylesheet" href="style.css">
  <style>
   body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

  </style>


 
</head>
<body>
  <header>
    <h1>Historique de la voiture</h1>
  </header>
  <main>
    <section>
      <table class="table">
        <thead>
          <tr>
            <th>Id Client</th>
            <th>Id vehicule</th>
            <th>Date Debut</th>
            <th>Date Fin</th>
            <th>Prix total</th>
          </tr>
        </thead>
        <tbody>
          <?php
         
          include('connexion.php');

          $idcom = connect('locationvoiturebd');
    $idcom->exec('USE locationvoiturebd');

        

if (isset($_POST['enregistrer'])) {
  $code = (int)$_POST['code'];
  $requete = "SELECT idclient,idvehicule,dateDebut,dateFin, prixTotal FROM locations WHERE idVehicule ='$code'";
  $result = $idcom->query($requete);
   
    
    $stmt = $idcom->prepare($requete);
    $stmt->execute();

    
    while ($resultat = $stmt->fetch()) {
        echo '<tr>';
        echo '<td>' . $resultat['idclient'] . '</td>';
        echo '<td>' . $resultat['idvehicule'] . '</td>';
        echo '<td>' . $resultat['dateDebut'] . '</td>';
        echo '<td>' . $resultat['dateFin'] . '</td>';
        echo '<td>' . $resultat['prixTotal'] . ' €</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="2">ID de véhicule non spécifié.</td></tr>';
}
          
          $idcom = null;
          ?>
        </tbody>
      </table>
    </section>
  </main>
  <footer>
    <p>Copyright &copy; 2023 Flestee</p>
  </footer>
</body>
</html>
