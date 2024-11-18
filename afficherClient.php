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

    </style>
 </head>
 <body>
    <?php
     
     include_once('connexion.php');
     $idcon =connect('locationvoiturebd');
     $idcon->exec('USE locationvoiturebd');
 
     $requete = "SELECT * FROM clients";
     $result = $idcon->query($requete);
 
     if (!$result) {
         $mes_error = $idcon->errorInfo();
         echo "Lecture est impossible, code " . $idcon->errorCode() . ", " . $mes_error[2];
     } else {
         $nbart = $result->rowCount();
         echo "L'agence contient  $nbart client(s).";
 
         if ($nbart > 0) {
            $ligne = $result->fetchObject();
            echo "<table border=\"1\"><tr>";
            $columns = array_keys((array) $ligne);
        
            foreach ($columns as $nomcol) {
                echo "<th>$nomcol</th>";
            }
        
            echo "</tr>";
        
            do {
                echo "<tr>";
                foreach ($columns as $nomcol) {
                    echo "<td>", $ligne->$nomcol, "</td>";
                }
        
                echo "</tr>";
            } while ($ligne = $result->fetchObject());
        
            echo "</table>";
        }
 
         $result->closeCursor();
         $idcon = null;
     }
     ?>
    
 </body>
 </html>