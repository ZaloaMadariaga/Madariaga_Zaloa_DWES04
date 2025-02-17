<?php
require_once "../DTO/reservationDTO.php";
require_once "../config/database_config.php";

class Reservation {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function createReservation($reservation) {
        $query = 'INSERT INTO reservas(id_usuario, habitacion, fecha_de_entrada, fecha_de_salida) VALUES (:id_usuario, :habitacion, :entrada, :salida)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $reservation['id_usuario'], PDO::PARAM_STR);
        $stmt->bindParam(':habitacion', $reservation['habitacion'], PDO::PARAM_STR);
        $stmt->bindParam(':entrada', $reservation['fecha_de_entrada'], PDO::PARAM_STR);
        $stmt->bindParam(':salida', $reservation['fecha_de_salida'], PDO::PARAM_STR);
        $stmt->execute();
    }
    public function getAllReservations() {
        // Aquí obtenemos todas las reservas desde la base de datos
        $query = 'SELECT reservas.id, usuarios.nombre AS usuario, reservas.habitacion, reservas.fecha_de_entrada, reservas.fecha_de_salida 
                  FROM reservas 
                  JOIN usuarios ON reservas.id_usuario = usuarios.id';
    
        $stmt = $this->pdo->query($query);
        
        // Obtenemos todas las reservas en formato de array asociativo
        $reservations= $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($reservations as $reservation) {
            $reservationDTOs[] = new ReservationDTO($reservation['id'], $reservation['usuario'], $reservation['habitacion'], $reservation['fecha_de_entrada'], $reservation['fecha_de_salida']);
        }
        return $reservationDTOs;
    }
    
    public function modify($id, $checkIn, $checkOut) {
        $query = 'UPDATE reservas SET fecha_de_entrada = :checkIn, fecha_de_salida = :checkOut WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':checkIn', $checkIn, PDO::PARAM_STR);
        $stmt->bindParam(':checkOut', $checkOut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function deleteReservation($id) {
        $query = 'DELETE FROM reservas WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    
}
?>
