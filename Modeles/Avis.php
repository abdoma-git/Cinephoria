<?php 

class Avis {
    private static $pdo;
    private static $table = "avis";

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public function __construct($pdo) {
        self::$pdo = $pdo;
    }

    public function create($user_id, $film_id, $note, $commentaire) {

        $sql = "INSERT INTO `avis`(`user_id`, `film_id`, `note`, `commentaire`, `valide`) VALUES (:a, :b, :c, :d, '0')";
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute([
            'a' => $user_id,
            'b' => $film_id,
            'c' => $note,
            'd' => $commentaire,
        ]);
    }

    public static function getAll($pdo) {
        $requette = $pdo->prepare("SELECT * FROM avis");
        $requette->execute();
        $avis = $requette->fetchAll();
        return $avis;
    }


}



?>