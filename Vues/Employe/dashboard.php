<?php

    session_start();
    require_once '../../config/database.php';
    require_once '../../Modeles/Employe.php';
    require_once '../../Modeles/Film.php';
    require_once '../../Modeles/Seance.php';
    require_once '../../Modeles/Salle.php';

    // Vérification de l'authentification
    if (!isset($_SESSION['employe_id'])) {
        header('Location: login.php');
        exit();
    }

    // Récupération des données
    try {
        $films = Film::getAll($pdo);
        $seances = Seance::getAll($pdo);
        $salles = Salle::getAll($pdo);
    } catch (PDOException $e) {
        $error = "Erreur lors de la récupération des données : " . $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Employé - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Cinephoria - Espace Employé</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="films.php">Films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="seances.php">Séances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salles.php">Salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="avis.php">Avis</a>
                    </li>
                </ul>
                <div class="navbar-text text-light me-3">
                    Bienvenue, <?php echo $_SESSION['employe_prenom'] . ' ' . $_SESSION['employe_nom']; ?>
                </div>
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Films</h5>
                        <p class="card-text"><?php echo count($films); ?> films enregistrés</p>
                        <a href="films.php" class="btn btn-primary">Gérer les films</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Séances</h5>
                        <p class="card-text"><?php echo count($seances); ?> séances programmées</p>
                        <a href="seances.php" class="btn btn-primary">Gérer les séances</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Salles</h5>
                        <p class="card-text"><?php echo count($salles); ?> salles disponibles</p>
                        <a href="salles.php" class="btn btn-primary">Gérer les salles</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Avis</h5>
                        <p class="card-text">Gérer les avis des films</p>
                        <a href="avis.php" class="btn btn-primary">Gérer les avis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 