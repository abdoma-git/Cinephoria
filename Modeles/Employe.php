<?php
class Employe {
    
    private $id;
    private $nom;
    private $prenom;
    private static $pdo;
    private $email;
    private $mot_de_passe;

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public function __construct($nom, $prenom, $email, $mot_de_passe) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public static function login($email, $mot_de_passe) {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM employer WHERE email = ?");
            $stmt->execute([$email]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && $mot_de_passe == $admin['mot_de_passe']) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_email'] = $admin['email'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion : " . $e->getMessage();
            return false;
        }
    }

    public function save($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO employer (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->nom, $this->prenom, $this->email, $this->mot_de_passe]);
            $this->id = $pdo->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de l'employé : " . $e->getMessage();
            return false;
        }
    }

    public static function getAll($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM employer");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des employés : " . $e->getMessage();
            return [];
        }
    }
}
?> 