<?php 

class Seance {
    private $pdo;
    private $table = "seances";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($heure_debut, $heure_fin, $qualite, $film_id, $salle_id) {
        $sql = "INSERT INTO {$this->table} (heure_debut, heure_fin, qualité, film_id, salle_id) 
                VALUES (:heure_debut, :heure_fin, :qualite, :film_id, :salle_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'qualite' => $qualite,
            'film_id' => $film_id,
            'salle_id' => $salle_id
        ]);
    }

    public function update($id,$heure_debut,$heure_fin,$qualité,$film_id,$salle_id) {
        $sql = "UPDATE `seances` SET `heure_debut`=:heure_debut,`heure_fin`=:heure_fin,`qualité`=:qualité,`film_id`=:film_id,`salle_id`=:salle_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'heure_debut' => $heure_debut,
            'heure_fin' => $heure_fin,
            'qualité' => $qualité,
            'film_id' => $film_id,
            'salle_id' => $salle_id,
            'id' => $id
        ]);
    }
    

    public function count_seances(){
        $stmt = $this->pdo->prepare("SELECT count(*) AS 'nbr_seance' FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }






    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByFilmId($film_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE film_id = :film_id");
        $stmt->execute(['film_id' => $film_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

?>
