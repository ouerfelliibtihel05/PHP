<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saissez vos informations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
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
    </style>
    <script>
        function calculateTotalPrice() {
            var startDate = new Date(document.getElementById("dated").value);
            var endDate = new Date(document.getElementById("datef").value);

            if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && startDate <= endDate) {
                var diffInDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24));
                var dailyPrice = parseFloat(document.getElementById("dailyPrice").value);
                var totalPrice = diffInDays * dailyPrice;

                document.getElementById("prixtotal").value = totalPrice.toFixed(2);
            } else {
                document.getElementById("prixtotal").value = "";
            }
        }
    </script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" oninput="calculateTotalPrice()">
        <fieldset>
            <legend><b>Les informations de location</b></legend>
            <table>
                <tr><td>DateDebut<input type="date" id="dated" name="dated" required/></td></tr>
                <br>
                <tr><td>DateFin<input type="date" id="datef" name="datef" required/></td></tr>
                <br>
                <tr><td>idClient<input type="text" name="idclient" ></td></tr>
                <br>
                <tr><td>idVehicule<input type="text" id="idvehicule" name="idvehicule" ></td></tr>
                <tr><td>PrixTotal<input type="text" id="prixtotal" name="prixtotal" readonly></td></tr>
                <tr>
                    <td><input type="reset" value="Effacer"/></td>
                    <td><input type="submit" value="Envoyer"/></td>
                </tr>
            </table>
            <input type="hidden" id="dailyPrice" name="dailyPrice" value="">
        </fieldset>
    </form>
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

      
        echo "<script type=\"text/javascript\">alert('Le prix total de la location est de : $prixTotal');</script>";

      
        $requete = "INSERT INTO locations (idclient, idvehicule, dateDebut, dateFin, prixTotal) 
                    VALUES ($idclient, $idvehicule, '$dated', '$datef', $prixTotal)";
        $nblignes = $idcon->exec($requete);

        if ($nblignes === 1) {
            echo "<script type=\"text/javascript\">alert('La réservation a été effectuée avec succès');</script>";
        } else {
            echo "Erreur lors de la réservation";
        }
    }

    $idcon = null;
}
?>




</body>
</html>
