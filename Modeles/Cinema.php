<?php 

    class Cinema {
        
        private $pdo;
        private $table = "cinemas";

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function create($nom, $adresse, $ville, $pays) {
            $sql = "INSERT INTO {$this->table} (nom, adresse, ville, pays) VALUES (:nom, :adresse, :ville, :pays)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(compact('nom', 'adresse', 'ville', 'pays'));
        }

        public function getAll() {
            $sql = "SELECT * FROM {$this->table}";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>