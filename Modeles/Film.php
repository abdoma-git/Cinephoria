<?php 

class Film {
    private $pdo;
    private $table = "films";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($titre, $description, $age_min, $note, $genre, $jour) {
        $sql = "INSERT INTO {$this->table} (titre, description, age_min, note, genre, jour) 
                VALUES (:titre, :description, :age_min, :note, :genre, :jour)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(compact('titre', 'description', 'age_min', 'note', 'genre', 'jour'));
    }

    public function getAll() {
        $requette = $this->pdo->prepare(" SELECT * FROM `films`");
        $requette->execute();
        $films = $requette->fetchAll();
        return films;
    }

    public function getFilmById($id) {
        $requette = $this->pdo->prepare(" SELECT * FROM `films` WHERE id=:id ");
        $requette->execute(['id'=>$id]);
        $film = $requette->fetch();
        return $film;
    }

}


?>