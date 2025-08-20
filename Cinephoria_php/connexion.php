<?php
    $servername = 'localhost';
    $dbname = "cinephoria";
    $username = "root";
    $password = "";

    try {

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connexion reussite avec la base de donnees " . $dbname . "\n" ;

    } catch (PDOException $erreur) {

        echo "Erreur de connexion : ". $erreur->getMessage(); 
    }
?>
