<?php
require_once '../controllers/UserController.php';
require_once '../controllers/ReservationController.php';

$action = $_POST['action'] ?? $_GET['action'] ?? "";
switch ($action) {
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;

    case 'login':
        $controller = new UserController();
        $controller->login();
        break;


    case 'createReservation':
        $controller = new ReservationController();
        $controller->createReservation();
        break;

    case 'getReservations':
        $controller = new ReservationController();
        $controller->getAllReservations();
        break;

    case 'admin':
        $controller = new UserController();
        $controller->admin();
        break;

        case 'modReservations':
            $controller = new ReservationController();
            $controller->modReservations();
            break;
        
        case 'deleteReservation':
            $controller = new ReservationController();
            $controller->deleteReservation();
            break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Acción no encontrada']);
        break;
}
?>