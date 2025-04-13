
<?php

    include('../Modeles/Voiture.php');

    $voiture1 = new Voiture('Mercedes', 200, 'Noire');

    $voiture1->getModele(); // Mercedes

    $voiture1->setModele('Audi'); // changer Mercedes en Audi
    $voiture1->setCouleur('Blanche'); // changer Mercedes en Audi

    echo " </br>";
    
    $voiture1->afficherVoiture();




?>