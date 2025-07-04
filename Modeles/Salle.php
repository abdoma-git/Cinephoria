<?php
class Salle {
    private $pdo;
    private $id;
    private $nbr_places;
    private $qualite_projection;
    private $cinema_id;

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public function __construct(...$args) {
        $n = count($args);

        // nouveau : construction par données
        if ($n === 3) {
            $this->nbr_places = $args[0]; 
            $this->qualite_projection = $args[1];
            $this->cinema_id = $args[2];

        // autre surcharge possible, par exemple avec un PDO
        } elseif ($n === 1 && $args[0] instanceof PDO) {
            // si tu veux initialiser un accès BD partagé
            $this->pdo = $args[0];

        } else {
            throw new InvalidArgumentException("Constructeur invalide, attendu soit (int, string, int) soit (PDO)");
        }
    }

    public function count_salle(){
        $stmt = $this->pdo->prepare("SELECT count(*) AS 'nbr_salle' FROM `salles`");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function save($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO salles (nbr_places, qualite_projection, cinema_id) VALUES (?, ?, ?)");
            $stmt->execute([$this->nbr_places, $this->qualite_projection, $this->cinema_id]);
            $this->id = $pdo->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de la salle : " . $e->getMessage();
            return false;
        }
    }

    

    public static function getAll($pdo) {
        $requette = $pdo->prepare("SELECT * FROM salles");
        $requette->execute();
        $salles = $requette->fetchAll();
        return $salles;
    }
}
?> 