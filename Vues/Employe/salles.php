<?php
session_start();
require_once '../../config/database.php';
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
                $salle = new Salle(
                    $_POST['nom'],
                    $_POST['capacite'],
                    $_POST['description']
                );
                $salle->save($pdo);
                break;
                
            case 'update':
                $salle = Salle::getById($pdo, $_POST['id']);
                if ($salle) {
                    $salle->setNom($_POST['nom']);
                    $salle->setCapacite($_POST['capacite']);
                    $salle->setDescription($_POST['description']);
                    $salle->update($pdo);
                }
                break;
                
            case 'delete':
                $salle = Salle::getById($pdo, $_POST['id']);
                if ($salle) {
                    $salle->delete($pdo);
                }
                break;
        }
    }
}

// Récupération des salles
$salles = Salle::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Salles - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Cinephoria - Gestion des Salles</a>
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
                        <a class="nav-link active" href="salles.php">Salles</a>
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
            <h2>Gestion des Salles</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSalleModal">
                <i class="bi bi-plus-circle"></i> Ajouter une salle
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Capacité</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salles as $salle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($salle['nom']); ?></td>
                        <td><?php echo htmlspecialchars($salle['capacite']); ?> places</td>
                        <td><?php echo htmlspecialchars($salle['description']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editSalle(<?php echo htmlspecialchars(json_encode($salle)); ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteSalle(<?php echo $salle['id']; ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ajout Salle -->
    <div class="modal fade" id="addSalleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une salle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacité</label>
                            <input type="number" class="form-control" name="capacite" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
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

    <!-- Modal Édition Salle -->
    <div class="modal fade" id="editSalleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier une salle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" id="edit_nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacité</label>
                            <input type="number" class="form-control" name="capacite" id="edit_capacite" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_description" required></textarea>
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
        function editSalle(salle) {
            document.getElementById('edit_id').value = salle.id;
            document.getElementById('edit_nom').value = salle.nom;
            document.getElementById('edit_capacite').value = salle.capacite;
            document.getElementById('edit_description').value = salle.description;
            new bootstrap.Modal(document.getElementById('editSalleModal')).show();
        }

        function deleteSalle(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')) {
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