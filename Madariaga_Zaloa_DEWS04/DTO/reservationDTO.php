<?php
class ReservationDTO {
    public int $id;
    public string $usuario;
    public string $habitacion;
    public string $fecha_entrada;
    public string $fecha_salida;

    public function __construct(int $id, string $usuario, string $habitacion, string $fecha_entrada, string $fecha_salida) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->habitacion = $habitacion;
        $this->fecha_entrada = $fecha_entrada;
        $this->fecha_salida = $fecha_salida;
    }

    public function toJSON(): string {
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
?>