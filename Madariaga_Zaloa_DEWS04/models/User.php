<?php
require_once "../config/database_config.php";
class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }
    

    public function register($username, $password) {
        $role= "user";
        $query = 'INSERT INTO usuarios(nombre, contraseña, rol) VALUES (:username, :password, :role)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function login($username, $password) {
        $query = 'SELECT contraseña FROM usuarios WHERE nombre = :username';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if( $password === $user['contraseña']) {
                return true;
            }
        }
        return false;
      
    }
    public function checkAdmin($password) {
        $query = 'SELECT * FROM usuarios WHERE nombre = :username';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && $user['rol'] === 'ADMIN';
    }

    public function userExists($username) {
        $query = 'SELECT COUNT(*) FROM usuarios WHERE nombre = :username';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result > 0;
    }
}
?>