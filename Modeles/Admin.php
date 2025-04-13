<?php
class Admin {
    private static $pdo;
    private $id;
    private $email;
    private $mot_de_passe;

    public static function setPdo($pdo) {
        self::$pdo = $pdo;
    }

    public static function login($email, $mot_de_passe) {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM admin WHERE email = ?");
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

    public static function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    public static function logout() {
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?> 