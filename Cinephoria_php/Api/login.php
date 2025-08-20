<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include("../connexion.php"); // connexion PDO

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["message" => "Champs requis manquants."]);
    exit();
}

$email = $data["email"];
$password = $data["password"];

try {
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur base de données : " . $e->getMessage()]);
    exit();
}

// Chercher un utilisateur avec le bon email
foreach ($users as $user) {
    if ($user["email"] === $email) {
        
        if ($user["mot_de_passe"] === md5($password)) {
            echo json_encode([
                "message" => "Connexion réussie",
                "user" => [
                    "id" => $user["id"],
                    "nom" => $user["nom"],
                    "email" => $user["email"]
                ]
            ]);
            exit();
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Mot de passe incorrect."]);
            exit();
        }
    }
}

// Si aucun utilisateur trouvé
http_response_code(404);
echo json_encode(["message" => "Utilisateur non trouvé."]);
?>
