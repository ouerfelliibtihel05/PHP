<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>Supprimez le client</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        form {
            max-width: 400px;
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
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <fieldset>
            <legend><b>donner votre identifiant pour supprimer </b></legend>
            <table>
                <tbody>
                    <tr>
                        <td>email du client :</td>
                        <td><input type="text" name="code" size="20" maxlength="40"/></td>
                    </tr>
                    <tr>
                        <td>Supprimer :</td>
                        <td><input type="submit" name="supprimer" value="Supprimer"/></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <?php
include('connexion.php');
$idcom = connect('locationvoiturebd');
$idcom->exec('USE locationvoiturebd');

if (isset($_POST['supprimer'])) {
    $code = $_POST['code'];
    $code = $idcom->quote($code);

   
    $checkQuery = "SELECT * FROM clients WHERE email = $code";
    $checkResult = $idcom->query($checkQuery);

    if ($checkResult->rowCount() > 0) {
       
        $deleteQuery = "DELETE FROM clients WHERE email = $code";
        $deleteResult = $idcom->exec($deleteQuery);

        if ($deleteResult !== false) {
            echo "<script type=\"text/javascript\">alert('Le client a été supprimé avec succès');setTimeout(function() { window.location.href = 'menuadmin.php'; }, 1000)</script>";
        } else {
            echo "<script type=\"text/javascript\">alert('Erreur lors de la suppression du client : " . $idcom->errorCode() . "')</script>";
        }
    } else {
        echo "<script type=\"text/javascript\">alert('Le client avec l'identifiant $code n'existe pas')</script>";
    }
}
?>
</body>
</html>