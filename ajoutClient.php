<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter client </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
      
      body {
  background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Arial', sans-serif;
}

.container {
    width: 100%;
  padding-right: $padding-x;
  padding-left: $padding-x;
  margin-right: auto;
  margin-left: auto;
}

h1 {
    color: #343a40;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #495057;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
}


input[type="text"]:hover {
    
   
    background-color:rgba(0, 128, 0, 0.5);
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
    background-color: green;
}


    </style>
</head>

<body>
    <h2>Ajouter Client</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="nom">nom:</label>
        <input type="text"  name="nom" required><br>

        <label for="prenom">prenom:</label>
        <input type="text"  name="prenom" required><br>

        <label for="adresse">adresse:</label>
        <input type="text"  name="adresse" required><br>

        <label for="Numtelephone">Numtelephone:</label>
        <input type="text"  name="NumTel" required><br>

        <label for="email">email:</label>
        <input type="text" id="email" name="email" required><br>
        <label >Motpasse</label>
        <input type="text"  name="motpasse" required><br>

        <input type="submit" value="ajouter">
        <input type="submit" value="se connecter" onclick="ToAjout()">
        
    </form>

    <?php
    session_start();

    
    
    include('connexion.php');
    $idcon = connect('locationvoiturebd');

    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['NumTel']) && !empty($_POST['email']) && !empty($_POST['motpasse'])) {
        $idcon->exec('USE locationvoiturebd');

        $idclient = "'/N'"; 
        $nom = $idcon->quote($_POST['nom']);
        $prenom = $idcon->quote($_POST['prenom']);
        $adresse= $idcon->quote($_POST['adresse']);
        $NumTel =$idcon->quote($_POST['NumTel']); 
        $email= $idcon->quote($_POST['email']);
        $motpasse= $idcon->quote($_POST['motpasse']);
        $emailExists = $idcon->query("SELECT COUNT(*) FROM clients WHERE email = $email")->fetchColumn();

        if ($emailExists > 0) {
            echo "<script type=\"text/javascript\">alert('Email already in use.')</script>";
        } else {
            $requete = "INSERT INTO clients VALUES ($idclient,$nom, $prenom, $adresse,$NumTel,$email, $motpasse)";

        $nblignes = $idcon->exec($requete);
       

        if ($nblignes !== 1) {
            $mess_erreur = $idcon->errorInfo();
            echo "Insertion impossible, code ", $idcon->errorCode();
        } 
        else {
            echo "<script type=\"text/javascript\">alert('votre compte est crée  avec succès')</script>";
        }
    }

        $idcon = null;

    }


   
    ?>
     <script>
        function ToAjout() {
            window.location.href = 'sinscrire.php';
        }
    </script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UoTqs5hNU5z6blDSa3Uc3foNkOkATDILKnyt2XoNHDHe0rj6ePtbmss3au1nt0bV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6TlD4yYF+4Zfahe7veN9x6wkUJ9TI9Kj0Xhx" crossorigin="anonymous"></script>

</body>
</html>