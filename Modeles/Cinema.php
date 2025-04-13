<?php 

    class Cinema {
        
        private static $pdo;
        private static $table = "cinemas";

        public static function setPdo($pdo) {
            self::$pdo = $pdo;
        }

        public function __construct($pdo) {
            self::$pdo = $pdo;
        }

        public function create($nom, $adresse, $ville, $pays) {
            $sql = "INSERT INTO " . self::$table . " (nom, adresse, ville, pays) VALUES (:nom, :adresse, :ville, :pays)";
            $stmt = self::$pdo->prepare($sql);
            return $stmt->execute(compact('nom', 'adresse', 'ville', 'pays'));
        }

        public static function getAll() {
            $sql = "SELECT * FROM " . self::$table;
            return self::$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>