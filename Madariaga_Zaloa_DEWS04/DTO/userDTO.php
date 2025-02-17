<?php
class UserDTO {
    public int $id;
    public string $username;
    public string $password;
    public string $role;

    public function __construct(int $id, string $username, string $password, string $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password= $password ;
        $this->role = $role;
    }

    public function toJSON(): string {
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
?>