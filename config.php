

<?php

try {
    $bdd = new PDO("mysql:host=localhost;dbname=gestion_entreprise_vente_vehicule;", 'root', '');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
} catch (PDOException $e) {
    die($e -> getMessage());
}


?>
