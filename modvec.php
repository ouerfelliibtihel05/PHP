<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>Modifiez vos informations de vehicules</title>

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
    <form action="modifVehicule.php" method="POST">
        <fieldset>
            <legend><b>Saisissez votre identifiant de vehicule pour modifier </b></legend>
            <table>
                <tbody>
                    <tr>
                        <td>Identifiant de vehicule :</td>
                        <td><input type="text" name="code" size="20" maxlength="10"/></td>
                    </tr>
                    <tr>
                        <td>Modifier:</td>
                        <td><input type="submit" name="enregistrer" value="Modifier"/></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>
</body>
</html>











