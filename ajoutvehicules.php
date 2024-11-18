<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            color: #007bff; 
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            color: #007bff; 
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff; 
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><b>Les informations de véhicule</b></legend>
        <table>
            <tr><td>Marque<input type="text" name="marque" required/></td></tr>
            <br>
            <tr><td>Modele<input type="text" name="modele" required/></td></tr>
            <br>
            <tr><td>Annee<input type="text" name="annee" required/></td></tr>
            <br>
            <tr><td>Prix par Jour<input type="number" name="prixParJour" required/></td></tr>
            <tr><td>Image<input type="file" name="image" accept="image/*" required/></td></tr>
            <tr>
                <td><input type="reset" value="Effacer"/></td>
                <td><input type="submit" value="Envoyer"/></td>
            </tr>
        </table>
    </fieldset>
</form>

<?php



include_once('connexion.php');
$idcon =connect('locationvoiturebd');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['annee']) && !empty($_POST['prixParJour'])) {
        $idcon->exec('USE locationvoiturebd');


        $marque = $idcon->quote($_POST['marque']);
        $modele = $idcon->quote($_POST['modele']);
        $annee = $idcon->quote($_POST['annee']);
        $prixParJour = $idcon->quote($_POST['prixParJour']);

   
        $uploadDir = './images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "Le fichier est valide et a été téléchargé avec succès.\n";
            $image = $idcon->quote($_FILES['image']['name']);

            
            $requete = "INSERT INTO vehicules (marque, modele, annee, prixParJour, image) VALUES ($marque, $modele, $annee, $prixParJour, $image)";
            $nblignes = $idcon->exec($requete);

            if ($nblignes !== 1) {
                $mess_erreur = $idcon->errorInfo();
                echo "Insertion impossible, code ", $idcon->errorCode();
            } else {
                echo "Véhicule inséré avec succès";
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }

        $idcon = null;
    } else {
        echo "Le formulaire est incomplet";
    }
}

?>
</body>
</html>


