<?php

class Reservation {
    private $pdo;
    private $table = "reservations";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    // Créer une nouvelle réservation
    public function create($user_id, $seance_id, $film_id, $nombre_places, $date_reservation, $statut) {
        $sql = "INSERT INTO {$this->table} 
                (user_id, seance_id, film_id, nombre_places, date_reservation, statut) 
                VALUES (:user_id, :seance_id, :film_id, :nombre_places, :date_reservation, :statut)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'seance_id' => $seance_id,
            'seance_id' => $seance_id,
            'film_id' => $film_id,
            'nombre_places' => $nombre_places,
            'date_reservation' => $date_reservation,
            'statut' => $statut
        ]);
    }

    public function count_reservations(){
        $stmt = $this->pdo->prepare("SELECT count(*) AS 'nbr_reservation' FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les réservations
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une réservation par son ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les réservations d’un utilisateur
    public function getByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer une réservation
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Mettre à jour le statut d'une réservation
    public function updateStatut($id, $statut) {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET statut = :statut WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'statut' => $statut
        ]);
    }
}

?>
