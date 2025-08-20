<?php
    include('../../connexion.php');

    $table = $_GET["table"];
    $titre = $_GET["titre"];
    $id = $_GET["id"];

    $requette = $pdo->prepare("DELETE FROM ".$table." WHERE id=:id");
    $requette->execute(['id' => $id]);
    
    header('Location: lister.php?table='.$table.'&titre='.$titre.'');
?>