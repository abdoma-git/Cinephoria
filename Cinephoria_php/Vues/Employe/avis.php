<?php
session_start();
require_once '../../config/database.php';
require_once '../../Modeles/Avis.php';
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
            case 'validate':
                $avis = Avis::getById($pdo, $_POST['id']);
                if ($avis) {
                    $avis->setValide(true);
                    $avis->update($pdo);
                }
                break;
                
            case 'delete':
                $avis = Avis::getById($pdo, $_POST['id']);
                if ($avis) {
                    $avis->delete($pdo);
                }
                break;
        }
    }
}

// Récupération des avis
$avis = Avis::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Avis - Cinephoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Cinephoria - Gestion des Avis</a>
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
                        <a class="nav-link active" href="avis.php">Avis</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Gestion des Avis</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Utilisateur</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($avis as $unAvis): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($unAvis['film_titre']); ?></td>
                        <td><?php echo htmlspecialchars($unAvis['utilisateur_nom'] . ' ' . $unAvis['utilisateur_prenom']); ?></td>
                        <td><?php echo htmlspecialchars($unAvis['note']); ?>/5</td>
                        <td><?php echo htmlspecialchars($unAvis['commentaire']); ?></td>
                        <td><?php echo htmlspecialchars($unAvis['date_creation']); ?></td>
                        <td>
                            <?php if ($unAvis['valide']): ?>
                                <span class="badge bg-success">Validé</span>
                            <?php else: ?>
                                <span class="badge bg-warning">En attente</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!$unAvis['valide']): ?>
                            <button class="btn btn-sm btn-success" onclick="validateAvis(<?php echo $unAvis['id']; ?>)">
                                <i class="bi bi-check-circle"></i>
                            </button>
                            <?php endif; ?>
                            <button class="btn btn-sm btn-danger" onclick="deleteAvis(<?php echo $unAvis['id']; ?>)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateAvis(id) {
            if (confirm('Êtes-vous sûr de vouloir valider cet avis ?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="validate">
                    <input type="hidden" name="id" value="${id}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function deleteAvis(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')) {
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