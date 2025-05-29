<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../connexion.php";

if (!isset($_GET["user_id"])) {
    http_response_code(400);
    echo json_encode(["message" => "Paramètre 'user_id' manquant."]);
    exit();
}

$user_id = intval($_GET["user_id"]);
$today = date('Y-m-d');

try {
    $stmt = $pdo->prepare("
        SELECT 
            r.id AS reservation_id,
            r.nombre_places AS places,
            f.titre AS film,
            f.poster AS affiche,
            r.date_reservation AS jour_projection,
            s.heure_debut,
            s.heure_fin,
            sl.id AS numero_salle
        FROM reservations r
        JOIN seances s ON r.seance_id = s.id
        JOIN salles sl ON s.salle_id = sl.id
        JOIN films f ON s.film_id = f.id
        WHERE r.user_id = :user_id
          AND DATE(r.date_reservation) >= :today
        ORDER BY r.date_reservation DESC
    ");
    $stmt->execute(['user_id' => $user_id, 'today' => $today]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "message" => "Détails des réservations récupérés",
        "reservations" => $reservations
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur serveur : " . $e->getMessage()]);
}
