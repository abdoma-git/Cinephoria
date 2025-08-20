<?php 

class Film {

    private $pdo;
    private $table = "films";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function create($titre, $description, $age_min, $note, $genre, $date, $poster) {
        $sql = "INSERT INTO `films` (titre, description, age_min, note, genre, date, poster) 
                VALUES (:titre, :description, :age_min, :note, :genre, :date, :poster)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'age_min' => $age_min,
            'note' => $note,
            'genre' => $genre,
            'date' => $date,
            'poster' => $poster
        ]);
    }


    public function update($id, $titre, $description, $age_min, $note, $genre, $date, $poster) {
        $sql = "UPDATE `films` SET `titre`=:titre,`description`=:description,`age_min`=:age_min,`note`=:note,`genre`=:genre,`date`=:date,`poster`=:poster WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'age_min' => $age_min,
            'note' => $note,
            'genre' => $genre,
            'date' => $date,
            'poster' => $poster,
            'id' => $id
        ]);
    }
    
    
    
    
    public function count_films(){
        $stmt = $this->pdo->prepare("SELECT count(*) AS 'nbr_film' FROM `films`");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll($pdo) {
        $requette = $pdo->prepare("SELECT * FROM films");
        $requette->execute();
        $films = $requette->fetchAll();
        return $films;
    }

    public function getFilmById($pdo,$id) {
        $requette = $pdo->prepare("SELECT * FROM `films` WHERE id=:id");
        $requette->execute(['id'=>$id]);
        $film = $requette->fetch();
        return $film;
    }

    public static function getTop5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM `films` ORDER BY note DESC LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getLast5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM `films` ORDER BY id DESC LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getRandom5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM `films` ORDER BY RAND() LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }




}



?>