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
        $code = $_POST['code'];
        $requete = "SELECT * FROM clients WHERE email ='$code'";
        $result = $idcom->query($requete);

        $coord = $result->fetch(PDO::FETCH_NUM);
        echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
        echo "<fieldset>";
        echo "<legend><b>Modifier Vos informations de vehicule </b></legend>";
        echo "<table>";
        echo "<tr><td>nom : </td><td><input type=\"text\" name=\"nom\" size=\"size\" maxlength=\"30\" value=\"$coord[1]\"/></td></tr>";
        echo "<tr><td>prenom: </td><td><input type=\"text\" name=\"prenom\" size=\"size\" maxlength=\"30\" value=\"$coord[2]\"/></td></tr>";
        echo "<tr><td>adresse: </td><td><input type=\"text\" name=\"adresse\" size=\"size\" maxlength=\"30\" value=\"$coord[3]\"/></td></tr>";
        echo "<tr><td>NumTelephone: </td><td><input type=\"text\" name=\"NumTel\" size=\"size\" maxlength=\"30\" value=\"$coord[4]\"/></td></tr>";
        echo "<tr><td>email: </td><td><input type=\"text\" name=\"email\" size=\"size\" maxlength=\"40\" value=\"$coord[5]\"/></td></tr>";
        echo "<td><input type=\"reset\" value=\"effacer\"></td>";
        echo "<td><input type=\"submit\" name=\"modif\" value=\"enregistrer\"></td></table>";
        echo "<input type=\"hidden\" name=\"code\" value=\"$code\"/>";
        echo "</fieldset>";
        echo "</form>";
        $result->closeCursor();
        $idcom = null;
    } elseif (isset($_POST['modif'])) {
        $nom = $idcom->quote($_POST['nom']);
        $prenom = $idcom->quote($_POST['prenom']);
        $adresse = $idcom->quote($_POST['adresse']);
        $NumTel = $idcom->quote($_POST['NumTel']);
        $email = $idcom->quote($_POST['email']);
        $code = $idcom->quote($_POST['code']);  
        $requete = "UPDATE clients SET nom=$nom, prenom=$prenom, adresse=$adresse, NumTel=$NumTel, email=$email WHERE email=$code";
        $result = $idcom->exec($requete);

        if ($result !== 1) {
            echo "<script type=\"text/javascript\"> alert ('erreur : " . $idcom->errorCode() . "')</script>";
        } else {
            echo "<script type=\"text/javascript\">alert('Vos modifications ont été effectuées avec succès'); setTimeout(function() { window.location.href = 'menuclient.php'; }, 1000);</script>";
          
        }

        $idcom = null;
    } else {
        echo "Modifier vos coordonnées !!";
    }
    ?>
    </body>
    </html>