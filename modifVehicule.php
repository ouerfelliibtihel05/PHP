<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>Modifiez vos informations de vehicule</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="reset"],
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="reset"]:hover,
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
    include('connexion.php');
    $idcom = connect('locationvoiturebd');
    $idcom->exec('USE locationvoiturebd');

    if (isset($_POST['enregistrer'])) {
        $code = (int)$_POST['code'];
        $requete = "SELECT * FROM vehicules WHERE idVehicule ='$code'";
        $result = $idcom->query($requete);

        $coord = $result->fetch(PDO::FETCH_NUM);
        echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
        echo "<fieldset>";
        echo "<legend><b>Modifier Vos informations de vehicule </b></legend>";
        echo "<table>";
        echo "<tr><td>marque : </td><td><input type=\"text\" name=\"marque\" size=\"size\" maxlength=\"30\" value=\"$coord[1]\"/></td></tr>";
        echo "<tr><td>modele: </td><td><input type=\"text\" name=\"modele\" size=\"size\" maxlength=\"30\" value=\"$coord[2]\"/></td></tr>";
        echo "<tr><td>année: </td><td><input type=\"text\" name=\"annee\" size=\"size\" maxlength=\"30\" value=\"$coord[3]\"/></td></tr>";
        echo "<tr><td>prixParJour: </td><td><input type=\"text\" name=\"prixParJour\" size=\"size\" maxlength=\"30\" value=\"$coord[4]\"/></td></tr>";
        echo "<td><input type=\"reset\" value=\"effacer\"></td>";
        echo "<td><input type=\"submit\" name=\"modif\" value=\"enregistrer\"></td></table>";
        echo "<input type=\"hidden\" name=\"code\" value=\"$code\"/>";
        echo "</fieldset>";
        echo "</form>";
        $result->closeCursor();
        $idcom = null;
    } elseif (isset($_POST['modif'])) {
        $marque = $idcom->quote($_POST['marque']);
        $modele = $idcom->quote($_POST['modele']);
        $annee = $idcom->quote($_POST['annee']);
        $prixParJour= $idcom->quote($_POST['prixParJour']);
        $code = (int)$_POST['code'];
        $requete = "UPDATE vehicules SET marque=$marque, modele=$modele, annee=$annee, prixParJour=$prixParJour WHERE idVehicule=$code";
        $result = $idcom->exec($requete);

        if ($result !== 1) {
            echo "<script type=\"text/javascript\"> alert ('erreur : " . $idcom->errorCode() . "')</script>";
        } else {
            echo "<script type=\"text/javascript\">alert('vos modifications sont effectuées avec succès')</script>";
        }

        $idcom = null;
    } else {
        echo "Modifier vos coordonnées !!";
    }
    ?>
    </body>
    </html>