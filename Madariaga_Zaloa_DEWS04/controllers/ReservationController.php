<?php
require_once '../models/Reservation.php';

class ReservationController {
    public function createReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = [
                'id' => uniqid(),
                'usuario' => $_POST['usuario'],
                'habitacion' => $_POST['habitacion'],
                'fecha_entrada' => $_POST['fecha_entrada'],
                'fecha_salida' => $_POST['fecha_salida']
            ];
            $reservationModel = new Reservation();
            $reservationModel->createReservation($reservation);
            http_response_code(201);
            echo json_encode(['message' => 'Reserva creada correctamente']);
        }
    }

    public function getAllReservations() {
        $reservation = new Reservation();
        $reservations = $reservation->getAllReservations();
        http_response_code(200);
        echo json_encode($reservations);
    }

    public function modReservations() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservaID = $_POST['reservaID'];
            $newCheckin = $_POST['newCheckin'];
            $newCheckout = $_POST['newCheckout'];
    
            $reservationModel = new Reservation();
            $result = $reservationModel->modify($reservaID, $newCheckin, $newCheckout);
    
            if ($result) {
                http_response_code(200);
                echo json_encode(['message' => 'Reserva modificada correctamente']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Error al modificar la reserva']);
            }
        }
    }
    public function deleteReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservaID = $_POST['reservaID'];
            $reservationModel = new Reservation();
            $result = $reservationModel->deleteReservation($reservaID);
    
            if ($result) {
                http_response_code(200);
                echo json_encode(['message' => 'Reserva eliminada correctamente']);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Reserva no encontrada']);
            }
        }
    }
}
?>