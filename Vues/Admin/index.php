<?php
require_once 'check_auth.php';
require_once '../../connexion.php';
require_once '../../Modeles/Film.php';
require_once '../../Modeles/Salle.php';
require_once '../../Modeles/Seance.php';
require_once '../../Modeles/Employe.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php include('menu_admin.php');?>

    <div class="container mt-4">
        <h1>Bienvenue dans l'administration de Cinephoria</h1>
        <p>Utilisez le menu ci-dessus pour gérer les différentes sections du site.</p>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 