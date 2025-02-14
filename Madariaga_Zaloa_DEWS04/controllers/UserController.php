<?php
require_once '../models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->userExists($username)) {
                http_response_code(400);
                echo json_encode(['message' => 'El usuario ya existe.']);
                return;
            }

            $user->register($username, $password);
            http_response_code(201);
            echo json_encode(['message' => 'Usuario registrado correctamente']);
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = new User();
            $loggedInUser = $user->login($username, $password);
            if ($loggedInUser) {
                http_response_code(200);
                header("Location: ../views/rooms.html");   
                     } else {
                http_response_code(401);
                echo json_encode(['message' => 'Credenciales inválidas']);
            }
        }
    }

    public function admin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = new User();
            $loggedInUser = $user->login($username, $password);
            
            if ($loggedInUser) {
                http_response_code(200); 
                header("Location: ../views/gestion.html");            
              } else {
                http_response_code(403);
                echo json_encode(['message' => 'Acceso denegado']);
            }
        }
    }
}
?>