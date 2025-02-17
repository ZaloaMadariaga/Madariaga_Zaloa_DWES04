<?php
require_once '../models/Reservation.php';

class ReservationController {
    public function createReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = [
                'id_usuario' => $_POST['id_usuario'],
                'habitacion' => $_POST['habitacion'],
                'fecha_de_entrada' => $_POST['fecha_de_entrada'],
                'fecha_de_salida' => $_POST['fecha_de_salida']
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
        
        if ($reservations) {
            http_response_code(200);
            // Para pruebas o si quieres un formato JSON:
            echo json_encode($reservations);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'No hay reservas disponibles.']);
        }
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