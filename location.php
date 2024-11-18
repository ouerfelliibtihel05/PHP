<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saissez vos informations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <Style>body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
}

form {
  width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
}

h1 {
  text-align: center;
}

.row {
  margin-bottom: 10px;
}

label {
  font-weight: bold;
  margin-right: 10px;
}

input, select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
}

button {
  background-color: #000;
  color: #fff;
  padding: 10px;
  border: none;
  cursor: pointer;
}

input[type="checkbox"] {
  margin-right: 10px;
}
</Style>
</head>
<body>
<?php
include('connexion.php');
$idcon = connect('locationvoiturebd');

if (!empty($_POST['dated']) && !empty($_POST['datef']) && !empty($_POST['idclient']) && !empty($_POST['idvehicule'])) {
    $idcon->exec('USE locationvoiturebd');
    $idclient = $_POST['idclient'];
    $idvehicule = $_POST['idvehicule'];
    $dated = $_POST['dated'];
    $datef = $_POST['datef'];

    
    $checkReservationQuery = "SELECT COUNT(*) FROM locations WHERE idvehicule = $idvehicule 
                             AND ('$dated' BETWEEN dateDebut AND dateFin OR '$datef' BETWEEN dateDebut AND dateFin)";
    $existingReservations = $idcon->query($checkReservationQuery)->fetchColumn();

    if ($existingReservations > 0) {
        echo "<script type=\"text/javascript\">alert('La voiture est déjà réservée pour les dates spécifiées.');</script>";
    } else {
       
        $dailyPriceQuery = "SELECT prixParJour FROM vehicules WHERE idvehicule = $idvehicule";
        $dailyPrice = $idcon->query($dailyPriceQuery)->fetchColumn();

        $diff = strtotime($datef) - strtotime($dated);
        $numDays = floor($diff / (60 * 60 * 24));
        $prixTotal = $numDays * $dailyPrice;
        echo "<script type=\"text/javascript\">";
        echo "var confirmation = confirm('Le prix total de la location est de : $prixTotal. Voulez-vous confirmer la réservation ?');";
        echo "if (confirmation) {";
  
        $requete = "INSERT INTO locations (idclient, idvehicule, dateDebut, dateFin, prixTotal) VALUES ($idclient, $idvehicule, '$dated', '$datef', $prixTotal)";
        $nblignes = $idcon->exec($requete);
    
        if ($nblignes === 1) {
            echo "    alert('La réservation a été effectuée avec succès');";
        } else {
            echo "    alert('Erreur lors de la réservation');";
        }
    
        echo "} else {";
        echo "    alert('La réservation a été annulée.');";
        echo "}";
        echo "</script>";
    }
    
    $idcon = null;
}
?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
        <fieldset>
            <legend><b>Les informations de location</b></legend>
            <table>
                <tr><td>DateDebut<input type="Date" name="dated" required/></td></tr>
                <br>
                <tr><td>DateFin<input type="Date" name="datef" required/></td></tr>
                <br>
                <tr><td>idClient<input type="text" name="idclient"  value=""></td></tr>
                <br>
                <tr><td>idVehicule<input type="text" name="idvehicule" ></td></tr>
                <br>
                
	            
             
                <tr>
                    <td><input type="reset" value="Effacer"/></td>
                    <td><input type="submit" value="Envoyer"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
    
</body>
</html>