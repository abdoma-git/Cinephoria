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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Administration Cinephoria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="film.php">Gérer les films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salle.php">Gérer les salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="seance.php">Gérer les séances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employe.php">Gérer les employés</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Bienvenue dans l'administration de Cinephoria</h1>
        <p>Utilisez le menu ci-dessus pour gérer les différentes sections du site.</p>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 