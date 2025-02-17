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

            // Registrar el usuario
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
            $loggedInUser  = $user->login($username, $password);
            if ($loggedInUser ) {
                http_response_code(200);
                header("Location: ../views/rooms.html");
                exit(); // Asegúrate de salir después de la redirección
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
            $loggedInUser  = $user->login($username, $password);
            
            if ($loggedInUser ) {
                // Verificamos si el usuario tiene rol 'admin'
                if ($user->checkAdmin($username)) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'admin'; // Guardamos el rol del usuario
                    
                    http_response_code(200); 
                    header("Location: ../views/gestion.html"); // Redirigir a gestión de reservas
                    exit(); // Asegúrate de salir después de la redirección
                } else {
                    http_response_code(403);
                    echo json_encode(['message' => 'Acceso denegado, no eres administrador.']);
                }
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Credenciales inválidas']);
            }
        }
    }
}
?>