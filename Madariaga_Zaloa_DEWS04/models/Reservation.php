<?php
require_once "../config/database_config.php";

class Reservation {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }


    public function createReservation($reservation) {
        $query = 'INSERT INTO reservas(id_usuario, habitacion, fecha_de_entrada, fecha_de_salida) VALUES (:id_usuario, :habitacion,:entrada ,:salida)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $reservation ["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':habitacion', $reservation ["habitacion"], PDO::PARAM_STR);
        $stmt->bindParam(':entrada',  $reservation ["fecha_de_entrada"], PDO::PARAM_STR);

        $stmt->bindParam(':salida', $reservation ["fecha_de_salida"], PDO::PARAM_STR);
        $stmt->execute();
    }
    public function getAllReservations() {
        $query = 'SELECT * FROM reservas';
        $stmt = $this->pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; // Devuelve los resultados en lugar de hacer un var_dump
    }
    
    public function modify($id, $checkIn, $checkOut) {
        $query = 'UPDATE reservas SET fecha_de_entrada = :checkIn, fecha_de_salida = :checkOut WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':checkIn', $checkIn, PDO::PARAM_STR);
        $stmt->bindParam(':checkOut', $checkOut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); // Devuelve true si la actualización fue exitosa
    }
    public function deleteReservation($id) {
        $query = 'DELETE FROM reservas WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); // Devuelve true si la eliminación fue exitosa
    }
    
}
?>
