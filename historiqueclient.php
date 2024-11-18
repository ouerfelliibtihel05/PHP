<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historique du client </title>
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
    <h1>Historique du client </h1>
  </header>
  <main>
    <section>
      
       
        <?php

include('connexion.php');

$idcom = connect('locationvoiturebd');
$idcom->exec('USE locationvoiturebd');


if (isset($_POST['enregistrer'])) {
    $code = (int)$_POST['code'];
    

    $requete = "SELECT locations.idclient, dateDebut, dateFin,prixTotal, nom, prenom ,adresse,NumTel,email FROM locations
                INNER JOIN clients ON locations.idclient = clients.idClient
                WHERE locations.idclient = :code";

   
    $stmt = $idcom->prepare($requete);
    $stmt->bindParam(':code', $code, PDO::PARAM_INT);
    $stmt->execute();


    echo '<table>';
    echo '<tr><th>ID Client</th><th>Nom</th><th>Prénom</th><th>adresse</th><th>NumTel</th><th>email</th><th>Date Début</th><th>Date Fin</th><th>prixTotal</th></tr>';
    while ($resultat = $stmt->fetch()) {
        echo '<tr>';
        echo '<td>' . $resultat['idclient'] . '</td>';
        echo '<td>' . $resultat['nom'] . '</td>';
        echo '<td>' . $resultat['prenom'] . '</td>';
        echo '<td>' . $resultat['adresse'] . '</td>';
        echo '<td>' . $resultat['NumTel'] . '</td>';
        echo '<td>' . $resultat['email'] . '</td>';
        echo '<td>' . $resultat['dateDebut'] . '</td>';
        echo '<td>' . $resultat['dateFin'] . '</td>';
        echo '<td>' . $resultat['prixTotal'] . '</td>';
        
        
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'ID de client non spécifié.';
}


$idcom = null;
?>

      
    </section>
  </main>
  <footer>
    <p>Copyright &copy; 2023 Flestee</p>
  </footer>
</body>
</html>
