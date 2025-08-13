<?php

    class Utilisateur {
        private $pdo;
        private $table = "utilisateurs";

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function create($nom, $prenom, $nom_utilisateur, $email, $mot_de_passe) {
            
            $hash = md5($mot_de_passe);
            
            $sql = "INSERT INTO {$this->table} (nom, prenom, nom_utilisateur, email, mot_de_passe) 
                    VALUES (:nom, :prenom, :nom_utilisateur, :email, :mot_de_passe)";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                'nom' => $nom, 
                'prenom' => $prenom, 
                'nom_utilisateur' => $nom_utilisateur, 
                'email' => $email, 
                'mot_de_passe' => $hash
            ]);

        }


        public function nombre_utilisateur(){
            $stmt = $this->pdo->prepare("SELECT count(*) AS 'nbr_utilisateur' FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getByEmail($email, $pwd) {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email & mot_de_passe = :pwd";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'pwd' => $pwd]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function login($email, $mot_de_passe) {
            $sql = "SELECT * FROM {$this->table} WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
        
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                return $utilisateur; // Connexion réussie
            } else {
                return false; // Échec de connexion
            }
        }
    }


?>