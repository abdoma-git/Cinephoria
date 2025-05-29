<?php
session_start();
require_once '../../config/database.php';
require_once '../../Modeles/Seance.php';
require_once '../../Modeles/Film.php';
require_once '../../Modeles/Salle.php';

// Vérification de l'authentification
if (!isset($_SESSION['employe_id'])) {
    header('Location: login.php');
    exit();
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $seance = new Seance(
                    $_POST['film_id'],
                    $_POST['salle_id'],
                    $_POST['date_heure'],
                    $_POST['prix']
                );
                $seance->save($pdo);
                break;
                
            case 'update':
                $seance = Seance::getById($pdo, $_POST['id']);
                if ($seance) {
                    $seance->setFilmId($_POST['film_id']);
                    $seance->setSalleId($_POST['salle_id']);
                    $seance->setDateHeure($_POST['date_heure']);
                    $seance->setPrix($_POST['prix']);
                    $seance->update($pdo);
                }
                break;
                
            case 'delete':
                $seance = Seance::getById($pdo, $_POST['id']);
                if ($seance) {
                    $seance->delete($pdo);
                }
                break;
        }
    }
}

// Récupération des données
$seances = Seance::getAll($pdo);
$films = Film::getAll($pdo);
$salles = Salle::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Séances - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Cinephoria - Gestion des Séances</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="films.php">Films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="seances.php">Séances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salles.php">Salles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="avis.php">Avis</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Séances</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSeanceModal">
                <i class="bi bi-plus-circle"></i> Ajouter une séance
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Salle</th>
                        <th>Date et heure</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seances as $seance): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($seance['film_titre']); ?></td>
                        <td><?php echo htmlspecialchars($seance['salle_nom']); ?></td>
                        <td><?php echo htmlspecialchars($seance['date_heure']); ?></td>
                        <td><?php echo htmlspecialchars($seance['prix']); ?> €</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editSeance(<?php echo htmlspecialchars(json_encode($seance)); ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteSeance(<?php echo $seance['id']; ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ajout Séance -->
    <div class="modal fade" id="addSeanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une séance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Film</label>
                            <select class="form-select" name="film_id" required>
                                <?php foreach ($films as $film): ?>
                                <option value="<?php echo $film['id']; ?>"><?php echo htmlspecialchars($film['titre']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salle</label>
                            <select class="form-select" name="salle_id" required>
                                <?php foreach ($salles as $salle): ?>
                                <option value="<?php echo $salle['id']; ?>"><?php echo htmlspecialchars($salle['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date et heure</label>
                            <input type="datetime-local" class="form-control" name="date_heure" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" name="prix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Édition Séance -->
    <div class="modal fade" id="editSeanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier une séance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Film</label>
                            <select class="form-select" name="film_id" id="edit_film_id" required>
                                <?php foreach ($films as $film): ?>
                                <option value="<?php echo $film['id']; ?>"><?php echo htmlspecialchars($film['titre']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salle</label>
                            <select class="form-select" name="salle_id" id="edit_salle_id" required>
                                <?php foreach ($salles as $salle): ?>
                                <option value="<?php echo $salle['id']; ?>"><?php echo htmlspecialchars($salle['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date et heure</label>
                            <input type="datetime-local" class="form-control" name="date_heure" id="edit_date_heure" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" name="prix" id="edit_prix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editSeance(seance) {
            document.getElementById('edit_id').value = seance.id;
            document.getElementById('edit_film_id').value = seance.film_id;
            document.getElementById('edit_salle_id').value = seance.salle_id;
            document.getElementById('edit_date_heure').value = seance.date_heure;
            document.getElementById('edit_prix').value = seance.prix;
            new bootstrap.Modal(document.getElementById('editSeanceModal')).show();
        }

        function deleteSeance(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html> 