<?php
// models/User.php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertUser($data)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO Users (nombres, apellidos, cedulaRUC, telefono, fechaNacimiento, salario, email, contrasena) VALUES (:nombres, :apellidos, :cedulaRUC, :telefono, :fechaNacimiento, :salario, :email, :contrasena)");

            // Asignar valores a variables antes de pasarlas a bindParam
            $nombres = $data['nombres'];
            $apellidos = $data['apellidos'];
            $cedulaRUC = $data['cedulaRUC'];
            $telefono = $data['telefono'];
            $fechaNacimiento = $data['fechaNacimiento'];
            $salario = $data['salario'];
            $email = $data['email'];
            $contrasena = password_hash($data['contrasena'], PASSWORD_BCRYPT);

            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':cedulaRUC', $cedulaRUC);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
            $stmt->bindParam(':salario', $salario);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contrasena', $contrasena);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
