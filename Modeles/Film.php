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

    public static function getAll() {
        $requette = self::$pdo->prepare("SELECT * FROM " . self::$table);
        $requette->execute();
        $films = $requette->fetchAll();
        return $films;
    }

    public function getFilmById($id) {
        $requette = self::$pdo->prepare("SELECT * FROM " . self::$table . " WHERE id=:id");
        $requette->execute(['id'=>$id]);
        $film = $requette->fetch();
        return $film;
    }
}


?>