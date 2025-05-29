<?php
session_start();
require_once '../../config/database.php';
require_once '../../Modeles/Film.php';

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
                $film = new Film(
                    $_POST['titre'],
                    $_POST['description'],
                    $_POST['duree'],
                    $_POST['date_sortie'],
                    $_POST['genre']
                );
                $film->save($pdo);
                break;
                
            case 'update':
                $film = Film::getById($pdo, $_POST['id']);
                if ($film) {
                    $film->setTitre($_POST['titre']);
                    $film->setDescription($_POST['description']);
                    $film->setDuree($_POST['duree']);
                    $film->setDateSortie($_POST['date_sortie']);
                    $film->setGenre($_POST['genre']);
                    $film->update($pdo);
                }
                break;
                
            case 'delete':
                $film = Film::getById($pdo, $_POST['id']);
                if ($film) {
                    $film->delete($pdo);
                }
                break;
        }
    }
}

// Récupération des films
$films = Film::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Films - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Cinephoria - Gestion des Films</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="films.php">Films</a>
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
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Films</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFilmModal">
                <i class="bi bi-plus-circle"></i> Ajouter un film
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Durée</th>
                        <th>Date de sortie</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($films as $film): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($film['titre']); ?></td>
                        <td><?php echo htmlspecialchars($film['description']); ?></td>
                        <td><?php echo htmlspecialchars($film['duree']); ?> min</td>
                        <td><?php echo htmlspecialchars($film['date_sortie']); ?></td>
                        <td><?php echo htmlspecialchars($film['genre']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editFilm(<?php echo htmlspecialchars(json_encode($film)); ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteFilm(<?php echo $film['id']; ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ajout Film -->
    <div class="modal fade" id="addFilmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Durée (minutes)</label>
                            <input type="number" class="form-control" name="duree" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de sortie</label>
                            <input type="date" class="form-control" name="date_sortie" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <input type="text" class="form-control" name="genre" required>
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

    <!-- Modal Édition Film -->
    <div class="modal fade" id="editFilmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier un film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" id="edit_titre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Durée (minutes)</label>
                            <input type="number" class="form-control" name="duree" id="edit_duree" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de sortie</label>
                            <input type="date" class="form-control" name="date_sortie" id="edit_date_sortie" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <input type="text" class="form-control" name="genre" id="edit_genre" required>
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
        function editFilm(film) {
            document.getElementById('edit_id').value = film.id;
            document.getElementById('edit_titre').value = film.titre;
            document.getElementById('edit_description').value = film.description;
            document.getElementById('edit_duree').value = film.duree;
            document.getElementById('edit_date_sortie').value = film.date_sortie;
            document.getElementById('edit_genre').value = film.genre;
            new bootstrap.Modal(document.getElementById('editFilmModal')).show();
        }

        function deleteFilm(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce film ?')) {
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