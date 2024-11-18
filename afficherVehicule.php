<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .search-form {
            text-align: center;
            margin: 20px;
        }
        .search-form input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
        }
        .search-form button {
            padding: 8px 12px;
            font-size: 16px;
            border: none;
            background-color: #4caf50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <li class="nav-item">
        <a class="nav-link" href="./ajoutvehicules.php">AjouterV</a>
    </li>

    <!-- Formulaire de recherche par marque -->
    <div class="search-form">
        <form method="get" action="">
            <input type="text" name="marque" placeholder="Rechercher par marque" value="<?php echo isset($_GET['marque']) ? htmlspecialchars($_GET['marque']) : ''; ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <?php
        include_once('connexion.php');
        $idcon = connect('locationvoiturebd');
        $idcon->exec('USE locationvoiturebd');

        // Récupérer la valeur de la marque
        $marque = isset($_GET['marque']) ? $_GET['marque'] : '';

        // Construire la requête avec un filtre pour l'état = 1 (disponible) et la marque
        $requete = "SELECT * FROM vehicules WHERE etat = 1";

        // Ajouter un filtre pour la marque si elle est définie
        if ($marque) {
            $requete .= " AND marque LIKE :marque";
        }

        // Préparer la requête
        $stmt = $idcon->prepare($requete);

        // Lier le paramètre de la marque si nécessaire
        if ($marque) {
            $stmt->bindParam(':marque', $marqueParam, PDO::PARAM_STR);
            $marqueParam = '%' . $marque . '%';
        }

        $stmt->execute();

        if (!$stmt) {
            $mes_error = $idcon->errorInfo();
            echo "Lecture impossible, code " . $idcon->errorCode() . ", " . $mes_error[2];
        } else {
            $nbart = $stmt->rowCount();
            echo "<p style='text-align: center;'>L'agence contient $nbart véhicule(s) disponible(s).</p>";

            if ($nbart > 0) {
                $ligne = $stmt->fetchObject();
                echo "<table><tr>";

                // Afficher les noms de colonnes
                $columns = array_keys((array) $ligne);
                foreach ($columns as $nomcol) {
                    echo "<th>" . htmlspecialchars($nomcol) . "</th>";
                }
                echo "</tr>";

                // Afficher les lignes
                do {
                    echo "<tr>";
                    foreach ($columns as $nomcol) {
                        echo "<td>" . htmlspecialchars($ligne->$nomcol) . "</td>";
                    }
                    echo "</tr>";
                } while ($ligne = $stmt->fetchObject());

                echo "</table>";
            } else {
                echo "<p style='text-align: center;'>Aucun véhicule disponible trouvé avec les critères spécifiés.</p>";
            }

            $stmt->closeCursor();
        }
        $idcon = null;
    ?>
</body>
</html>
