<?php 

class Film {
    private static $pdo;
    private static $table = "films";

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public function __construct($pdo) {
        self::$pdo = $pdo;
    }

    public function create($titre, $description, $age_min, $note, $genre, $date, $poster) {
        $sql = "INSERT INTO " . self::$table . " (titre, description, age_min, note, genre, date, poster) 
                VALUES (:titre, :description, :age_min, :note, :genre, :date, :poster)";
        $stmt = self::$pdo->prepare($sql);
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

    public static function getAll($pdo) {
        $requette = $pdo->prepare("SELECT * FROM films");
        $requette->execute();
        $films = $requette->fetchAll();
        return $films;
    }

    public function getFilmById($pdo,$id) {
        $requette = $pdo->prepare("SELECT * FROM " . self::$table . " WHERE id=:id");
        $requette->execute(['id'=>$id]);
        $film = $requette->fetch();
        return $film;
    }

    public static function getTop5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM " . self::$table . " ORDER BY note DESC LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getLast5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM " . self::$table . " ORDER BY id DESC LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getRandom5($pdo) {
        $requette = $pdo->prepare("SELECT * FROM " . self::$table . " ORDER BY RAND() LIMIT 6");
        $requette->execute();
        return $requette->fetchAll(PDO::FETCH_ASSOC);
    }




}



?>