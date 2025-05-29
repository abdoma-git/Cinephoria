<?php
require_once '../../connexion.php';
require_once '../../Modeles/Seance.php';
require_once '../../Modeles/Film.php';
require_once '../../Modeles/Salle.php';

// Initialisation de la connexion PDO pour les classes
Film::setPdo($pdo);
Salle::setPdo($pdo);

// Récupération des séances du jour
$seance = new Seance($pdo);
$seances = $seance->getAll($pdo);
$films = Film::getAll($pdo);
$salles = Salle::getAll($pdo);

// Création d'un tableau d'index pour les films et les salles
$filmsIndex = [];
foreach ($films as $film) {
    $filmsIndex[$film['id']] = $film;
}

$sallesIndex = [];
foreach ($salles as $salle) {
    $sallesIndex[$salle['id']] = $salle;
}

// Fonction pour formater l'heure
function formatHeure($heure) {
    return date('H:i', strtotime($heure));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Employé - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .navbar-brand img {
            height: 60px;
        }
        .seance-card {
            transition: transform 0.2s;
        }
        .seance-card:hover {
            transform: translateY(-5px);
        }
        .film-poster {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="../../images/logo.png" width="100" height="100" alt="Cinephoria logo"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="bi bi-calendar-event"></i> Séances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservations.php">
                            <i class="bi bi-ticket-perforated"></i> Réservations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <h1 class="mb-4">Séances du jour</h1>
        
        <!-- Filtres -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select class="form-select" id="filmFilter">
                    <option value="">Tous les films</option>
                    <?php foreach ($films as $film): ?>
                        <option value="<?php echo $film['id']; ?>">
                            <?php echo htmlspecialchars($film['titre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="salleFilter">
                    <option value="">Toutes les salles</option>
                    <?php foreach ($salles as $salle): ?>
                        <option value="<?php echo $salle['id']; ?>">
                            Salle <?php echo $salle['id']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Liste des séances -->
        <div class="row" id="seancesList">
            <?php foreach ($seances as $seance): 
                $film = $filmsIndex[$seance['film_id']];
                $salle = $sallesIndex[$seance['salle_id']];
            ?>
                <div class="col-md-4 mb-4 seance-card" 
                     data-film="<?php echo $seance['film_id']; ?>"
                     data-salle="<?php echo $seance['salle_id']; ?>">
                    <div class="card h-100">
                        <img src="<?php echo $film['poster']; ?>" 
                             class="card-img-top film-poster" 
                             alt="<?php echo htmlspecialchars($film['titre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($film['titre']); ?></h5>
                            <p class="card-text">
                                <i class="bi bi-clock"></i> <?php echo formatHeure($seance['heure_debut']); ?> - <?php echo formatHeure($seance['heure_fin']); ?><br>
                                <i class="bi bi-geo-alt"></i> Salle <?php echo $salle['id']; ?><br>
                                <i class="bi bi-ticket-perforated"></i> <?php echo $seance['qualité']; ?>
                            </p>
                            <a href="reservation.php?id=<?php echo $seance['id']; ?>" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Nouvelle réservation
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filtrage des séances
        document.getElementById('filmFilter').addEventListener('change', filterSeances);
        document.getElementById('salleFilter').addEventListener('change', filterSeances);

        function filterSeances() {
            const filmFilter = document.getElementById('filmFilter').value;
            const salleFilter = document.getElementById('salleFilter').value;
            const seances = document.querySelectorAll('.seance-card');

            seances.forEach(seance => {
                const filmId = seance.dataset.film;
                const salleId = seance.dataset.salle;
                
                const filmMatch = !filmFilter || filmId === filmFilter;
                const salleMatch = !salleFilter || salleId === salleFilter;

                seance.style.display = (filmMatch && salleMatch) ? 'block' : 'none';
            });
        }
    </script>
</body>
</html> 