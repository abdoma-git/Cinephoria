<?php
class Salle {
    private static $pdo;
    private $id;
    private $nbr_places;
    private $qualite_projection;
    private $cinema_id;

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public function __construct($nbr_places, $qualite_projection, $cinema_id) {
        $this->nbr_places = $nbr_places;
        $this->qualite_projection = $qualite_projection;
        $this->cinema_id = $cinema_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNbrPlaces() {
        return $this->nbr_places;
    }

    public function getQualiteProjection() {
        return $this->qualite_projection;
    }

    public function getCinemaId() {
        return $this->cinema_id;
    }

    public function save() {
        try {
            $stmt = self::$pdo->prepare("INSERT INTO salles (nbr_places, qualite_projection, cinema_id) VALUES (?, ?, ?)");
            $stmt->execute([$this->nbr_places, $this->qualite_projection, $this->cinema_id]);
            $this->id = self::$pdo->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la salle : " . $e->getMessage();
            return false;
        }
    }

    public static function getAll() {
        try {
            $stmt = self::$pdo->query("SELECT * FROM salles");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des salles : " . $e->getMessage();
            return [];
        }
    }
}
?> 