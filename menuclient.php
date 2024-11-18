<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Voitures</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #f8f9fa; /* Adjust the color as needed */
            padding: 10px;
        }

        .navbar a {
            text-decoration: none;
            color: #000; /* Adjust the color as needed */
            margin-right: 15px;
        }

        .navbar .logout-link {
    order: 1; /* Move the LogOut link to the end */
}

        .menu-container {
            max-width: 800px;
            margin: 20px auto; /* Adjust the margin as needed */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align:center;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(calc(33.33% - 20px), 1fr));
            gap: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
        }

        .card img {
    max-width: 100%;
    height: 150px; /* Adjust the height as needed */
    object-fit: cover; /* This ensures the image covers the specified height without distorting its aspect ratio */
    border-radius: 8px; /* Optional: Add border-radius for rounded corners */
}

        .card-title {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .card-text {
            color: #555;
        }

        .card-link {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a>PrestigeCar Rental </a>
    <a href="./menuclient.php">Bienvenue</a>
    <a href="modclient.php">Modifier</a>
    <a href="sinscrire.php" >LogOut</a>
</div>

<div class="menu-container">
    <h1>Menu des Voitures</h1>
    <div class="card-container">
    <?php
include_once('connexion.php');
$idcon = connect('locationvoiturebd');
$idcon->exec('USE locationvoiturebd');

$requete = "SELECT * FROM vehicules";
$resultat = $idcon->query($requete);


if ($resultat !== false) {
    $vehicules = $resultat->fetchAll(PDO::FETCH_ASSOC);

    foreach ($vehicules as $vehicule  ) {
        $locationQuery = "SELECT * FROM locations WHERE idvehicule = {$vehicule['idVehicule']} LIMIT 1";
        $locationResult = $idcon->query($locationQuery);
        echo "<div class='card'>";
        
        echo "<img src='./images/{$vehicule['image']}' alt='Car Image'>";
        echo "<h5 class='card-title'>Marque: {$vehicule['marque']} </h5>";
        echo "<p class='card-text'> Modele : {$vehicule['modele']}</p>";
        echo "<p class='card-text'> Id Vehicule : {$vehicule['idVehicule']}</p>";
        echo "<p class='card-text'>annee:{$vehicule['annee']}</p>";
        echo "<p class='card-text'>Prix par Jour: {$vehicule['PrixParJour']}</p>";

        if ($locationResult->rowCount() > 0) {
            
            echo "<p class='card-text'>Statut: Indisponible</p>";
        } else {
           
            echo "<p class='card-text'>Statut: Disponible</p>";
            echo "<a href='location.php' class='card-link'>Réserver</a>";
        }
        echo "</div>";
    }
} else {
 
    $errorInfo = $idcon->errorInfo();
    echo "Error: {$errorInfo[2]}";
}

$idcon = null;
?>
    </div>
</div>



<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Contact Information</h3>
                <p>Email: prestigecarrental@gmail.com</p>
                <p>Phone: +1 123-456-7890</p>
                <p>Address: 123 Street, City, sfax</p>
            </div>
            <div class="col-md-6">
                <h3>Follow Us</h3>
                <p>Connect with us on social media for updates and more:</p>
                <ul class="social-icons">
                    
                <li><a href="https://www.facebook.com/ibtihel.werfelli?mibextid=LQQJ4d" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-instagram-square"></i></a></li>
                  </ul>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



</body>
</html>